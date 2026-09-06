# SPEC: SCSS フォント指定の集中管理と Makinas 4 の試行

- 対象: hatatate テーマ (`assets/scss/`)
- ベースラインコミット: `2e621a8`
- 作成日: 2026-09-06

## 背景（実測に基づく現状）

フォント指定が以下の 6 箇所に分散しており、変更のたびに全ファイルを追う必要がある。

| 場所 | 内容 |
|---|---|
| `header.php:24-33` | Google Fonts の `<link>` 5 行（計 10 ファミリ） |
| `_typography.scss:1-9` | `@font-face` 2 件（armed-lemon / yosugara） |
| `_typography.scss` 58,64,69,74,81,88,95,212,402,498 | `font-family` 10 箇所 |
| `_common.scss:9` | **`font:` ショートハンドでの body 基本フォント**（`font-family` 検索では発見できない） |
| `_common.scss` 808,1061 | `font-family` 2 箇所 |
| `_navbar.scss` 6,91 / `_button.scss:3` / `_forms.scss:22` / `_pricelist.scss:73` / `_widgets.scss:55` / `_media_querries.scss:27` | 各パーシャルへの直書き |

`_config.scss` にはフォント変数が存在しない。

### 確認済みの事実

- 実際に読み込まれる CSS は `assets/scss/style.css` のみ（`header.php:51`）。テーマルートの `style.css` は未使用の残骸
- 未使用 Google Fonts 6 ファミリ（Open Sans / M PLUS 1p / Zen Kaku Gothic Antique / Kosugi Maru / Sawarabi Mincho / Slackside One）は、読み込まれる CSS 内で参照ゼロ
- 既存 `style.css` は現行 SCSS とほぼ一致（sass 1.104.0 との差分は `right: 0px` → `-0px` の 1 行のみ）

## 受入条件

### AC-1: 回帰（デグレなし）の保証
`$font-test: null` の状態で `style.scss` をコンパイルし、**`@font-face` ブロックを除去した結果**が、同じ処理をかけたリファクタ前ベースライン CSS と **1 バイトも違わないこと**。

`@font-face` を比較対象から外す理由: `_fonts.scss` への移設で出力位置が変わり（現在 1350 行目 → 冒頭）、さらに Makinas 4 の 2 件が加わるため、この部分の差分は意図的なものである。
除外されるのは全体 109,410 bytes 中 **227 bytes（0.2%）**のみで、`@font-face` の中身は AC-6 が個別に検証するため検出力は落ちない。

ベースライン: `test/__snapshots__/style.baseline.css`（リファクタ着手前に sass 1.104.0 で生成済み。109,410 bytes / 5,586 行、`@font-face` 2 件）

### AC-2: 1 変数での全体切り替え
`$font-test` に `"Makinas-4-Flat"` を指定してコンパイルすると、以下すべての `font-family` の**先頭**に `Makinas-4-Flat` が入ること。
- `body`（`_common.scss:9` の `font:` ショートハンド由来）
- `.font-alt` / `.font-serif` / `.font-slackside-one` / `.font-yosugara` / `.font-yosugara-medium` / `.font-yosugara-large` / `.font-armed-lemon`
- `.blog-contents` / `.navbar` / `.btn` / フォーム入力 / `.pricelist`

`"Makinas-4-Square"` でも同様に成立すること。

### AC-3: フォールバックの保全
`$font-test` 指定時も、既存のフォールバック（`Noto Sans JP`、`Hiragino Kaku Gothic ProN`、`sans-serif` 等）が**先頭に追加されるだけで、消えないこと**。
Makinas 4 は AdobeJapan1-3 収録のため、未収録文字はフォールバックで表示される必要がある。

### AC-3b: $font-test を適用しない例外（テスト作成時に確定）

以下の 3 つは `$font-test` の対象外とし、現状のまま出力すること。

| 対象 | 理由 |
|---|---|
| `FontAwesome` 指定箇所（4 箇所） | アイコンが文字化けするため（AC-4 で保証） |
| `'object-fit: cover;'`（`.of-cover`） | フォント指定ではなく IE ポリフィルのハック（AC-5 で保証） |
| `beloved-script`（`.font-beloved`） | `@font-face` も読み込みも無い死んだ指定。PHP テンプレートでの使用箇所も **0 件**。ここに `$font-test` を効かせると、死んでいたクラスが Makinas で生き返るという意図しない変化が起きる。非目標「`.font-beloved` は触らない」と整合させる |

### AC-4: アイコンフォントの非汚染（重要）
`FontAwesome` を指定している箇所（`_widgets.scss:55` / `_common.scss:808` / `_navbar.scss:91` / `_media_querries.scss:27`）は、`$font-test` の値に**関わらず** `FontAwesome` 単独のままであること。
※ ここに Makinas が混入するとアイコンが文字化けする。

### AC-5: IE ポリフィルハックの保全
`_common.scss:1154` の `font-family: 'object-fit: cover;'` は、`$font-test` の影響を受けず、そのまま出力されること。

### AC-6: @font-face の登録
コンパイル結果に `armed-lemon` / `yosugara` / `Makinas-4-Flat` / `Makinas-4-Square` の 4 つの `@font-face` が含まれ、`src` の参照先ファイルが実在すること。

### AC-7: null 時の非混入
`$font-test: null` のとき、`@font-face` ブロック以外に `Makinas` の文字列が現れないこと。

### AC-8: 未使用 Google Fonts の削除
`header.php` から未使用 6 ファミリの読み込みが除かれ、`Roboto Condensed` / `Volkhov` / `Noto Sans JP` / `Sawarabi Gothic` は残ること。

## 非目標（今回やらないこと）

- `font-size` / `font-weight` / `line-height` の集中管理（`font-size` は 160 箇所超、`_media_querries.scss` に 43 箇所あり、レイアウト崩れリスクが高いため別タスク）
- `@import` から `@use` / `@forward` への移行（全パーシャル書き換えとなりデグレリスク大。deprecation 警告 32 件は既知の負債として据え置く）
- クラス名と実体の不一致の是正（`.font-slackside-one` 等）。PHP 側 50 箇所超の置換を伴うため別タスク
- `.font-beloved` の削除・修正（`beloved-script` は未定義で sans-serif に落ちている既知の不具合。別タスク）
- テーマルートの未使用 `style.css` の削除
- OTF → WOFF2 変換（採用決定後の別タスク）
- `.DS_Store` の追跡解除

## 境界・例外

| ケース | 期待 |
|---|---|
| `$font-test: null` | 既存と完全同一の CSS |
| `$font-test: "Makinas-4-Flat"` | 全対象の先頭に挿入。フォールバックは保持 |
| `$font-test: "Makinas-4-Square"` | 同上 |
| FontAwesome 指定箇所 | 常に不変 |
| `'object-fit: cover;'` ハック | 常に不変 |
| Makinas 未収録文字 | フォールバックフォントで表示（CSS 上はスタック維持で担保） |

## 実装制約

1. 新規 `assets/scss/_fonts.scss` を作り、`style.scss` の**先頭**で `@import "fonts";` する
2. `$font-test` は **`!default` 付きで宣言**すること（テストから外部オーバーライドするために必須）
3. Sass 変数のみを使う（CSS カスタムプロパティは使わない）
4. `_common.scss:1154` の `object-fit` ハックには触れない
5. アイコンフォント用の変数は `$font-test` を経由させない
6. OTF は `assets/fonts/Makinas4/` に配置する

## 影響範囲

| ファイル | 操作 |
|---|---|
| `assets/scss/_fonts.scss` | 新規 |
| `assets/scss/style.scss` | `@import "fonts";` 追加 |
| `assets/scss/_typography.scss` | `@font-face` 移設 + 10 箇所を変数化 |
| `assets/scss/_common.scss` | 3 箇所を変数化（うち 1 は `font:` ショートハンド） |
| `assets/scss/_navbar.scss` | 2 箇所 |
| `assets/scss/_button.scss` / `_forms.scss` / `_pricelist.scss` / `_widgets.scss` / `_media_querries.scss` | 各 1 箇所 |
| `header.php` | 未使用 Google Fonts の link 削除 |
| `assets/fonts/Makinas4/` | OTF 2 ファイル配置 |
| `package.json` | sass を devDependency 追加、`scripts.test` / `scripts.build:css` 整備 |
| `test/` | テスト新規 |

## テスト方針

- ランナー: Node 標準 `node --test`（追加フレームワークなし）
- コンパイル: `sass` の JS API
- `$font-test` の差し替えは、一時 SCSS に `$font-test: "..."; @import "style";` を書いて実現（`!default` により外部定義が優先される）
- ベースライン: `test/__snapshots__/style.baseline.css`（**リファクタ着手前に、sass 1.104.0 で生成して固定する**）
- `<TEST_CMD>`: `npm test`

## ロールバック

`git reset --hard 2e621a8`（プッシュ済みのベースライン）

---

## 実施結果（2026-09-06 完了）

### テスト

```
ℹ tests 49
ℹ pass  49
ℹ fail  0
```

AC-1 〜 AC-8 のすべてを満たして完了。テストは `test/fonts.test.mjs`。

### 実際の CSS 差分

`assets/scss/style.css` の変更は **+17 / -9 行**で、内訳は次の通り。既存スタイルの変更はゼロ。

- `@font-face` 4 件が冒頭に追加（既存 2 件の移設 + Makinas 2 件の新規）
- 移設元の `@font-face` 2 件を削除
- `right: 0px` → `right: -0px`（sass のバージョン差による表記ゆれ。CSS として同値）

### Makinas 4 の試行結果 → **不採用**

Flat / Square の両方を実際にサイトへ適用して確認した結果、今回は採用しない判断となった。

| 観点 | 所見 |
|---|---|
| 可読性 | 両書体とも装飾性が高く、本文（長文）では可読性が落ちる。特に Square |
| 適用範囲 | 英数字にも効くため、日付・価格などの数字表現も変わる |
| 欠字 | AdobeJapan1-3 収録。トップページの範囲では欠字は発生しなかった。スタック維持により未収録文字はフォールバックする |
| ファイルサイズ | OTF 各 1.5MB。本番採用するなら WOFF2 化がほぼ必須 |

`@font-face` と OTF はリポジトリに残してあるため、`_fonts.scss` の `$font-test` を
`"Makinas-4-Flat"` または `"Makinas-4-Square"` に書き換えるだけで即座に再試行できる。

### 別タスクとして残した項目

- `font-size` / `font-weight` の集中管理（160 箇所超）
- `@import` → `@use` 移行（deprecation 警告 33 件）
- クラス名と実体の不一致（`.font-slackside-one` 等）
- `.font-beloved` の削除（`beloved-script` は未定義。PHP 使用箇所 0 件）
- テーマルートの未使用 `style.css` の削除
- Makinas を採用する場合の WOFF2 変換
- `.DS_Store` の追跡解除
