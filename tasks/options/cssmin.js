module.exports = {
	options: {
		banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
		' * <%=pkg.homepage %>\n' +
		' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
		' * Licensed MIT' +
		' */\n'
	},
	minify: {
		expand: true,

		cwd: 'assets/css/',
		src: ['additive.css', 'normalize.css', 'skeleton.css', 'font-awesome.css'],

		dest: 'assets/css/',
		ext: '.min.css'
	}
};
