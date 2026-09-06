import { describe, it } from 'node:test';
import assert from 'node:assert/strict';
import fs from 'node:fs';
import path from 'node:path';
import { compileCss, stripFontFaces, BASELINE_PATH, THEME_ROOT, SCSS_DIR } from './helpers/compile.mjs';

const baseline = fs.readFileSync(BASELINE_PATH, 'utf8');
const variants = [null, 'Makinas-4-Flat', 'Makinas-4-Square'];
// 同じ設定は一度だけコンパイルし、全受入条件で共有する。
const compiled = new Map(variants.map(font => [font, compileCss(font)]));

// 出力済み CSS の末端ルールを読む。メディアクエリ内のルールも対象。
function rules(css) {
  return [...css.replace(/\/\*[\s\S]*?\*\//g, '').matchAll(/([^{}]+)\{([^{}]*)\}/g)]
    .map(([, selector, body]) => ({
      // 先頭の @charset / @import / @namespace などを除く。引用符内の ; は保持する。
      selector: selector.replace(/^(?:\s*@[\w-]+(?:[^;"']|"(?:\\.|[^"\\])*"|'(?:\\.|[^'\\])*')*;)+/, '').trim(),
      body,
    }));
}
function declaration(body, property) {
  // 引用符内のセミコロン（object-fit ハック）を値の一部として扱う。
  const entries = [...body.matchAll(/(?:^|;)\s*([\w-]+)\s*:\s*((?:"[^"]*"|'[^']*'|[^;"'])*)/g)];
  return entries.filter(([, name]) => name === property).at(-1)?.[2].trim();
}
function family(rule) {
  const explicit = declaration(rule.body, 'font-family');
  if (explicit !== undefined) return explicit;
  const shorthand = declaration(rule.body, 'font');
  // 現行 CSS の font ショートハンドからサイズ・行高を除いて取得する。
  return shorthand?.match(/\b\d+(?:\.\d+)?(?:px|rem|em|%)\s*(?:\/\s*[^\s]+)?\s+(.+)$/)?.[1];
}
function stack(value) {
  assert.equal(typeof value, 'string', 'フォント宣言が存在すること');
  return value.split(',').map(part => part.trim().replace(/^(['"])(.*)\1$/, '$2'));
}
const baseRules = rules(stripFontFaces(baseline));
const targets = ['body', '.font-alt', '.font-serif', '.font-slackside-one',
  '.font-yosugara', '.font-yosugara-medium', '.font-yosugara-large',
  '.font-armed-lemon', '.blog-contents', '.navbar-custom', '.btn',
  '.form-control', '.pricelist-table-block .table-responsive table'];
function matching(css, selector) {
  return rules(stripFontFaces(css)).filter(rule => rule.selector === selector && family(rule) !== undefined);
}

describe('SCSS フォント集中管理の受入条件', () => {
  it('AC-1: null 時は font-face 以外がベースラインとバイト単位で一致する', () => {
    // 改行・空白を含めて既存のレイアウト出力を保護する。
    assert.ok(Buffer.from(stripFontFaces(compiled.get(null))).equals(Buffer.from(stripFontFaces(baseline))));
  });

  for (const font of variants.slice(1)) {
    for (const selector of targets) {
      it(`AC-2: ${font} が ${selector} の先頭になる`, () => {
        // body のショートハンド、フォーム、実際の navbar/pricelist セレクタも検証する。
        const found = matching(compiled.get(font), selector);
        assert.ok(found.length > 0, `${selector} のフォント宣言が存在すること`);
        for (const rule of found) assert.equal(stack(family(rule))[0], font, `${selector} の先頭フォント`);
      });
    }
    it(`AC-3: ${font} は既存スタックの先頭にだけ追加される`, () => {
      // 指定対象に加え、既存のテキスト用宣言全体の順序・フォールバックを守る。
      const expectedRules = baseRules.filter(rule => family(rule) !== undefined
        && !['FontAwesome', 'object-fit: cover;', 'beloved-script'].includes(stack(family(rule))[0]));
      const occurrences = new Map();
      for (const original of expectedRules) {
        const index = occurrences.get(original.selector) ?? 0;
        occurrences.set(original.selector, index + 1);
        const actual = matching(compiled.get(font), original.selector)[index];
        assert.ok(actual, `${original.selector} が残ること`);
        assert.deepEqual(stack(family(actual)), [font, ...stack(family(original))], original.selector);
      }
    });
  }

  for (const font of variants) {
    it(`AC-4: ${font} 時も全4箇所の FontAwesome は単独のまま`, () => {
      // メディアクエリ内とショートハンドのアイコン宣言も含める。
      const icons = baseRules.filter(rule => family(rule) && stack(family(rule))[0] === 'FontAwesome');
      assert.equal(icons.length, 4);
      const actualRules = rules(stripFontFaces(compiled.get(font)));
      const actualIcons = actualRules.filter(rule => family(rule) && stack(family(rule)).includes('FontAwesome'));
      assert.deepEqual(actualIcons.map(rule => [rule.selector, stack(family(rule))]),
        icons.map(rule => [rule.selector, ['FontAwesome']]));
    });
    it(`AC-5: ${font} 時も object-fit ハックが保持される`, () => {
      // 引用符内のセミコロンを含むポリフィル用の値を保護する。
      const actual = matching(compiled.get(font), '.of-cover');
      assert.equal(actual.length, 1);
      assert.equal(family(actual[0]), '"object-fit: cover;"');
    });
    for (const name of ['armed-lemon', 'yosugara', 'Makinas-4-Flat', 'Makinas-4-Square']) {
      it(`AC-6: ${font} 時に ${name} の font-face と実在する src がある`, () => {
        // 登録の欠落・重複と、CSS の配置場所を基準とするリンク切れを検出する。
        const faces = rules(compiled.get(font)).filter(rule => rule.selector === '@font-face'
          && stack(family(rule))[0] === name);
        assert.equal(faces.length, 1, `${name} の @font-face が1件登録されること`);
        const src = declaration(faces[0].body, 'src');
        assert.ok(src, `${name} の src が存在すること`);
        const urls = [...src.matchAll(/url\(\s*['"]?([^'"\s)]+)['"]?\s*\)/g)].map(match => match[1]);
        assert.ok(urls.length > 0, `${name} にファイル URL があること`);
        for (const url of urls) assert.ok(fs.statSync(path.resolve(SCSS_DIR, decodeURIComponent(url))).isFile(), url);
      });
    }
  }
  it('AC-7: null 時は font-face 以外に Makinas が混入しない', () => {
    // フォントの登録と適用を区別し、試行無効時の非混入を確認する。
    assert.doesNotMatch(stripFontFaces(compiled.get(null)), /Makinas/i);
  });

  it('AC-8: Google Fonts は使用中の4ファミリだけを読み込む', () => {
    // CSS に現れない外部フォント読み込みだけは header.php を読み取る。
    const header = fs.readFileSync(path.join(THEME_ROOT, 'header.php'), 'utf8').replace(/<!--[\s\S]*?-->/g, '');
    const families = new Set();
    for (const link of header.matchAll(/<link\b[^>]*>/gi)) {
      const href = link[0].match(/\bhref\s*=\s*(['"])(.*?)\1/i)?.[2];
      if (!href?.startsWith('https://fonts.googleapis.com/css')) continue;
      const url = new URL(href.replace(/&amp;/g, '&'));
      for (const group of url.searchParams.getAll('family')) {
        for (const entry of group.split('|')) families.add(entry.split(':')[0]);
      }
    }
    assert.deepEqual([...families].sort(), ['Roboto Condensed', 'Volkhov', 'Noto Sans JP', 'Sawarabi Gothic'].sort());
  });
});
