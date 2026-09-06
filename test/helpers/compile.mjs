// SCSS コンパイル用のテストヘルパー。
// ベースライン生成とテスト本体で必ず同じ手順を使うために切り出してある。
import * as sass from "sass";
import fs from "node:fs";
import os from "node:os";
import path from "node:path";
import { fileURLToPath } from "node:url";

const HERE = path.dirname(fileURLToPath(import.meta.url));
export const THEME_ROOT = path.resolve(HERE, "../..");
export const SCSS_DIR = path.join(THEME_ROOT, "assets/scss");

const COMPILE_OPTIONS = {
	loadPaths: [SCSS_DIR],
	// @import の deprecation 警告が 32 件出るが既知の負債（SPEC 非目標）。
	// テスト出力を読めなくするので黙らせる。
	logger: sass.Logger.silent,
};

/**
 * style.scss をコンパイルして CSS 文字列を返す。
 * @param {string|null} fontTest - $font-test に流し込む値。null なら未指定のまま。
 */
export function compileCss(fontTest = null) {
	if (fontTest === null) {
		return sass.compile(path.join(SCSS_DIR, "style.scss"), COMPILE_OPTIONS).css;
	}
	// $font-test は _fonts.scss 側で !default 宣言されている前提。
	// 先に定義してから読み込むことで外部からオーバーライドする。
	const entry = `$font-test: ${JSON.stringify(fontTest)};\n@import "style";\n`;
	const tmp = path.join(
		fs.mkdtempSync(path.join(os.tmpdir(), "hatatate-scss-")),
		"entry.scss",
	);
	fs.writeFileSync(tmp, entry);
	try {
		return sass.compile(tmp, COMPILE_OPTIONS).css;
	} finally {
		fs.rmSync(path.dirname(tmp), { recursive: true, force: true });
	}
}

/** @font-face ブロックを丸ごと取り除く（回帰比較で意図的な追加分を除外するため）。 */
export function stripFontFaces(css) {
	return css.replace(/@font-face\s*\{[^}]*\}\s*/g, "");
}

export const BASELINE_PATH = path.join(HERE, "../__snapshots__/style.baseline.css");
