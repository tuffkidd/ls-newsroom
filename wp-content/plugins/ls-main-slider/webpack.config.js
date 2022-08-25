const fs = require('fs')
const path = require('path')

const webpack = require('webpack')
const autoprefixer = require('autoprefixer')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')

module.exports = (env, argv) => {
	if (argv.mode === 'production') {
		console.log('Production build starting...')
	} else {
		console.log('Development watching...')
	}

	const config = {
		watchOptions: {
			aggregateTimeout: 200,
			poll: 1000,
			ignored: '**/node_modules'
		},
		cache: false,
		context: path.resolve(__dirname, 'assets'),
		devtool: 'source-map',
		mode: argv.mode === 'production' ? 'production' : 'development',
		entry: {
			'ls-main-slider-frontend': ['./js/admin/app.js'],
			'ls-main-slider-backend': ['./js/app.js']
		},
		output: {
			path: path.resolve(__dirname, 'assets/dist/'),
			publicPath: '/wp-content/plugins/ls-main-slider/assets/dist/',
			filename: '[name].js'
			// sourceMapFilename: "[name].js.map",
		},
		plugins: [
			new BrowserSyncPlugin(
				// BrowserSync options
				{
					proxy: 'news.lscns.test',
					port: '3007',
					open: false,
					files: [
						{
							match: ['**/*.php', '**/*.css', '**/*.js'],
							fn: function (event, file) {
								console.log('이벤트', event)
								console.log('파일', file)
								if (event === 'change') {
									const bs = require('browser-sync').get('bs-webpack-plugin')
									bs.reload()
								}
							}
						}
					]
				},
				{
					reload: false
				}
			),
			// extractCSS,
			new MiniCssExtractPlugin({
				filename: '[name].css'
			})
		],
		module: {
			rules: [
				{
					test: /\.(js|jsx)?$/,
					exclude: /(node_modules)/,
					use: {
						loader: 'babel-loader'
					}
				},
				{
					test: /\.js$/,
					enforce: 'pre',
					use: ['source-map-loader']
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader
						},
						{
							loader: 'css-loader',
							options: {
								url: false,
								sourceMap: true
							}
						},
						{
							loader: 'postcss-loader'
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: true
							}
						}
					]
				}
			]
		},
		performance: {
			hints: false
		},
		optimization: {
			minimize: true,
			minimizer: [
				new TerserPlugin({
					terserOptions: {
						format: {
							comments: false
						}
					},
					extractComments: false
				})
				// new OptimizeCssAssetsPlugin({})
			]
		},
		resolve: {
			// module: ['node_modules']
			// extension: ['.js', '.json', '.jsx', '.css']
		}
	}

	return config
}
