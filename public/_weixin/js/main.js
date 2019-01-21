/**
 * 站点程序入口文件（采用requireJs规范）
 * 
 */
requirejs.config({
	baseUrl: '/_weixin/js',

	//已baseUrl为基础定义不同js文件的路径
	//文件路径不可包含后缀名 js
	paths: {
		//引入jQuery和bootstrap
		jquery: 'https://cdn.bootcss.com/jquery/3.3.1/jquery.min',
		'jquery-weui': 'https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.min',
		fastclick: 'https://cdn.bootcss.com/fastclick/1.0.6/fastclick.min',
		'city-picker': '../../vendor/weui/city-picker',
		//jquery validate
		jqueryValidate: 'https://cdn.bootcss.com/jquery-validate/1.18.0/jquery.validate.min',
		//area
		area : '../../vendor/area',
		//swiper
		swiper : '../../vendor/swiper/js/swiper',
		//lrz
		lrz : '../../vendor/localResizeIMG-4.9.35/lrz.bundle',
	},

	map: { //map告诉RequireJS在任何模块之前，都先载入这个模块
		'*': {
			css: 'css.min' //定义require-css文件
		}
	},

	shim: {
		'jquery-weui': {
			deps: [
				'jquery',
			],
		},
	},
});

// Start the main app 
requirejs(
	[
		'jquery', 'jquery-weui'
	],
	function($) {
		requirejs(['fastclick'], function(FastClick) {
			FastClick.attach(document.body);
		})
		requirejs(['App'], function(App) {
			App.init()
		})
	});