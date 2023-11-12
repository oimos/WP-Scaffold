const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: {
    'js/custom': './src/index.js',
  },
  output: {
    path: path.resolve(__dirname, 'custom'),
    filename: '[name].js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader'
        ]
      },
    ]
  },
  optimization: {
    minimizer: [new CssMinimizerPlugin()],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'style.css'
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: 'http://media-service.local',
      files: [
        '**/*.php',
        'custom/css/*.css',
        'custom/js/*.js',
      ]
    })
  ],
  mode: 'development' // or 'production'
};
