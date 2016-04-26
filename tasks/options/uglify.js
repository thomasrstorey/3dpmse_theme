module.exports = {
	all: {
		files: {
			'assets/js/additive.min.js': ['assets/js/additive.js']
		},
		options: {
			banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
			' * <%= pkg.homepage %>\n' +
			' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
			' * Licensed MIT' +
			' */\n',
			mangle: {
				except: ['jQuery']
			}
		}
	}
};
