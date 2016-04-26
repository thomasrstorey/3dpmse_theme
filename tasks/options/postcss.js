module.exports = {
	dist: {
		options: {
			processors: [
				require('autoprefixer')({browsers: 'last 2 versions'})
			]
		},
		files: {
			'assets/css/additive.css': [ 'assets/css/src/additive.css' ],
			'assets/css/normalize.css': [ 'assets/css/src/normalize.css' ],
			'assets/css/font-awesome.css': [ 'assets/css/src/font-awesome.css' ],
			'assets/css/skeleton.css': [ 'assets/css/src/skeleton.css' ]
		}
	}
};
