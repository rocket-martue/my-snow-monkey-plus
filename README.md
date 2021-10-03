# My Snow Monkey+

子テーマの `functions.php` にカスタマイズコードを追加するように、このプラグインの `my-snow-monkey-plus.php` に書くと、同じようにカスタマイズが反映されます。

## 定数

下記の定数が利用可能です。

### MY_SNOW_MONKEY_URL

My Snow Monkey プラグインディレクトリへの URL

### MY_SNOW_MONKEY_PATH

My Snow Monkey プラグインディレクトリへの ファイルパス

### functions ディレクトリ

/functions ディレクトリの中にある php file は、自動的に読み込まれます。
その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込まれません。
Snow Monkey に依存しないコードは、こちらのディレクトリに配置します。

### inc ディレクトリ

/inc ディレクトリの中にある php file は、自動的に読み込まれます。
その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込まれません。
Snow Monkey に依存するコードは、こちらのディレクトリに配置します。