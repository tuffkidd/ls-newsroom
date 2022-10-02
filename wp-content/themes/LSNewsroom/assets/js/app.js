import 'normalize.css'

import '../sass/_main.scss' // main

import '../../node_modules/flatpickr/dist/themes/light.css'
import flatpickr from 'flatpickr'
const Korean = require('flatpickr/dist/l10n/ko.js').default.ko
flatpickr.localize(Korean)

import Utils from './utils'

import './common'

switch (Utils.currentPage) {
	case 'index':
		import('./index')
		break
	case 'search':
		import('./search')
		break
	case 'category':
		import('./category')
		break
	case 'single':
		import('./single')
		break
	case 'medialibrary':
		import('./medialibrary')
		import('./video')
		break
}
