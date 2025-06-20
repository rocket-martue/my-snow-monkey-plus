# My Snow Monkey+

Snow Monkey 用カスタマイズコードを管理するプラグインです。
My Snow Monkey と同じように使用できます。
機能ごとにファイルを分割管理するのに便利なようになっています。

## 🎯 主な特徴

- **自動ファイル読み込み**: 各ディレクトリのPHPファイルを自動で読み込み
- **テーマ依存管理**: Snow Monkey テーマ専用機能とテーマ非依存機能を分離
- **モダンなコード構造**: クラスベースの設計で保守性向上
- **SCSS サポート**: フロント用とエディター用のスタイルを効率的に管理

## 📁 ファイル構造

```
my-snow-monkey-plus/
├── my-snow-monkey-plus.php     # メインプラグインファイル
├── includes/                   # プラグイン本体のクラスファイル
│   └── class-my-snow-monkey-plus.php
├── functions/                  # テーマ非依存のカスタマイズ
├── snow-monkey/               # Snow Monkey テーマ専用のカスタマイズ
├── src/                       # リソースファイル
│   ├── css/                   # コンパイル済みCSS
│   ├── scss/                  # SCSSソースファイル
│   ├── js/                    # JavaScript
│   └── images/                # 画像ファイル
└── README.md
```

## 🔧 定数

下記の定数が利用可能です。

### MY_SNOW_MONKEY_URL

My Snow Monkey プラグインディレクトリへの URL

```php
// 使用例
wp_enqueue_style( 'custom-style', MY_SNOW_MONKEY_URL . '/src/css/style.css' );
```

### MY_SNOW_MONKEY_PATH

My Snow Monkey プラグインディレクトリへの ファイルパス

```php
// 使用例
require_once MY_SNOW_MONKEY_PATH . '/includes/helper-functions.php';
```

## 📂 機能ごとにファイルを分割管理

### functions ディレクトリ

`/functions` ディレクトリの中にある PHP ファイルは、自動的に読み込まれます。
その際、ファイル名がハイフンで始まるもの（例：`-example.php`）は、読み込まれません。

**✅ 配置するコード:**
- テーマに依存しない汎用的なカスタマイズ
- WordPress 標準機能の拡張
- プラグイン同士の連携機能

### snow-monkey ディレクトリ

`/snow-monkey` ディレクトリの中にある PHP ファイルは、Snow Monkey テーマが有効な場合のみ自動的に読み込まれます。
その際、ファイル名がハイフンで始まるもの（例：`-example.php`）は、読み込まれません。

**✅ 配置するコード:**
- Snow Monkey テーマ専用のカスタマイズ
- Snow Monkey のフックやフィルターを使用する機能
- テーマ固有のブロックスタイルやカラーパレット

### includes ディレクトリ

プラグインの中核となるクラスファイルを配置します。

**含まれるファイル:**
- `class-my-snow-monkey-plus.php`: メインクラス

## 🎨 SCSS 開発

### 構造

```
src/scss/
├── _variables.scss      # CSS カスタムプロパティ（色定義など）
├── _common.scss         # 共通スタイル
├── _block-style.scss    # ブロックスタイル（mixin + 直接出力）
├── style.scss          # フロント用エントリーポイント
└── editor-style.scss   # エディター用エントリーポイント
```

### エディター用とフロント用の分離

- **フロント用** (`style.scss`): そのままブロックスタイルを出力
- **エディター用** (`editor-style.scss`): `.editor-styles-wrapper` でラップしてブロックスタイルを出力

## 🔄 自動読み込み機能

プラグインは以下の順序でファイルを読み込みます：

1. **メインクラスの初期化** (`My_Snow_Monkey_Plus::get_instance()`)
2. **functions ディレクトリのファイル読み込み** (テーマ非依存)
3. **Snow Monkey テーマチェック**
4. **snow-monkey ディレクトリのファイル読み込み** (テーマ依存)

## 🛡️ テーマサポート

Snow Monkey テーマ以外が有効になっている場合：
- 管理画面に警告メッセージを表示
- `snow-monkey` ディレクトリのファイル読み込みをスキップ
- `functions` ディレクトリのファイルは引き続き動作

## 📝 開発のベストプラクティス

### ファイル命名規則

- **有効なファイル**: `feature-name.php`
- **無効なファイル**: `-disabled-feature.php` (ハイフン開始)

### コード配置の判断

| 機能の種類 | 配置先 | 例 |
|-----------|--------|-----|
| WordPress標準機能のカスタマイズ | `functions/` | カスタム投稿タイプ、管理画面カスタマイズ |
| Snow Monkey専用機能 | `snow-monkey/` | テーマフック、ブロックスタイル、カラーパレット |
| 共通ユーティリティ | `includes/` | ヘルパークラス、共通関数 |

## 📋 Version History

### Version 1.0.2

- **Snow Monkey テーマ判定の改善**: より確実で効率的な判定ロジックに変更
- **子テーマサポートの削除**: Snow Monkey 本体テーマでのみ動作するように変更
- **コード品質の向上**: PHPCSに準拠したコーディングスタイルに統一
- **判定ロジックの最適化**: 不要な処理を削除してパフォーマンス向上

### Version 1.0.1

- モダンなコード構造への リファクタリング
- クラスベースの設計でメンテナンス性向上
- SCSS のエディター/フロント分離対応
- 自動読み込み機能の効率化 (`glob()` 使用)
- オートローダー除外規則の変更 (ハイフン1つ開始)