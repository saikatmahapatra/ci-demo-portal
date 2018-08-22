// CI App Gruntfile
module.exports = function (grunt) { // jshint ignore:line
  'use strict'

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      /*less: {
        // Compiles less files upon saving
        files: ['assets/src/less/*.less'],
        tasks: ['less:development', 'less:production', 'notify:less']
      },*/
	  sass : {        
        files: ['assets/src/sass/*.scss'],
        tasks: ['sass','notify:sass']
      },
      js: {
        // Compile js files upon saving
        files: ['assets/src/js/*.js'],
        tasks: ['js', 'notify:js']
      }
    },
    // Notify end of tasks
    notify: {
      less: {
        options: {
          title: 'CI App',
          message: 'LESS finished running'
        }
      },
	  sass: {
        options: {
          title  : 'My App',
          message: 'Ok. SASS done'
        }
      },
      js: {
        options: {
          title: 'CI App',
          message: 'JS bundler finished running'
        }
      }
    },
    // 'less'-task configuration
    // This task will compile all less files upon saving to create both CI App.css and CI App.min.css
    less: {
      // Development not compressed
      development: {
        files: {
          // compilation.css  :  source.less
          'assets/dist/css/styles.css': 'assets/src/less/styles.less',
          'assets/dist/css/admin.css': 'assets/src/less/admin.less'
        }
      },
      // Production compressed version
      production: {
        options: {
          compress: true
        },
        files: {
          // compilation.css  :  source.less
          'assets/dist/css/styles.min.css': 'assets/src/less/styles.less',
          'assets/dist/css/admin.min.css': 'assets/src/less/admin.less'
        }
      }
    },

    //Copy files
    copy: {
      main: {
        expand: false,
        src: 'assets/src/js/*.js',
        dest: 'assets/dist/js/',
      },
    },

    //Copy 
    copy: {
      main: {
        expand: true,
        cwd: 'assets/src/js/',
        src: '**',
        dest: 'assets/dist/js/',
        flatten: true,
        filter: 'isFile',
      },
    },

    // Uglify task info. Compress the js files.
    uglify: {
      options: {
        mangle: true,
        preserveComments: 'some'
      },
      production: {
        files: {          
          'assets/dist/js/app.min.js': ['assets/src/js/app.js'],
        }
      }
    },

    // Concatenate JS Files
    concat: {
      options: {
        separator: '\n\n',
        banner: '/*! \n'
          //+ '* \n'
          //+ '* ================\n'
          //+ '* Main JS application file for CI App v2. This file\n'
          //+ '* should be included in all pages. It controls some layout\n'
          //+ '* options and implements exclusive CI App plugins.\n'
          //+ '*\n'
          + '* @Author  Saikat Mahapatra\n'
          + '* @Support \n'
          + '* @Email   <mahapatra.saikat29@gmail.com>\n'
          + '* @version <%= pkg.version %>\n'
          + '* @repository <%= pkg.repository.url %>\n'
          + '* @license MIT <http://opensource.org/licenses/MIT>\n'
          + '*/\n\n'
        //+ '// Make sure jQuery has been loaded\n'
        //+ 'if (typeof jQuery === \'undefined\') {\n'
        //+ 'throw new Error(\'CI App requires jQuery\')\n'
        //+ '}\n\n'
      },
      dist: {
        src: ['assets/src/js/app.js'],
        dest: 'assets/dist/js/app.js'
      }
    },

    // Replace image paths in CI App without plugins
    /*replace: {
      withoutPlugins   : {
        src         : ['assets/dist/css/alt/CI App-without-plugins.css'],
        dest        : 'assets/dist/css/alt/CI App-without-plugins.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      },
      withoutPluginsMin: {
        src         : ['assets/dist/css/alt/CI App-without-plugins.min.css'],
        dest        : 'assets/dist/css/alt/CI App-without-plugins.min.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      }
    },*/

    // Build the documentation files
    /*includes: {
      build: {
        src    : ['*.html'], // Source files
        dest   : 'documentation/', // Destination directory
        flatten: true,
        cwd    : 'documentation/build',
        options: {
          silent     : true,
          includePath: 'documentation/build/include'
        }
      }
    },*/

    // Optimize images
    image: {
      dynamic: {
        files: [
          {
            expand: true,
            cwd: 'assets/src/img/',
            src: ['**/*.{png,jpg,gif,svg,jpeg}'],
            dest: 'assets/dist/img/'
          }
        ]
      }
    },

    // Validate JS code
    jshint: {
      options: {
        jshintrc: 'assets/src/js/.jshintrc'
      },
      grunt: {
        options: {
          jshintrc: 'assets/src/grunt/.jshintrc'
        },
        src: 'Gruntfile.js'
      },
      core: {
        src: 'assets/src/js/*.js'
      }
    },

    jscs: {
      options: {
        config: 'assets/src/js/.jscsrc'
      },
      core: {
        src: '<%= jshint.core.src %>'
      }
    },

    // Validate CSS files
    csslint: {
      options: {
        csslintrc: 'assets/src/less/.csslintrc'
      },
      dist: [
        'assets/dist/css/styles.css'
      ]
    },

    // Validate Bootstrap HTML
    //bootlint: {
    //options: {
    //relaxerror: ['W005']
    //},
    //files  : ['pages/**/*.html', '*.html']
    // },

    // Delete images in build directory
    // After compressing the images in the build/img dir, there is no need
    // for them
    clean: {
      build: ['assets/src/img/*']
    },
	
	// SASS to CSS
	sass: {
		dist: {
			options: {
				outputStyle: 'expanded',
				sourceMap: false
			},
			files: [{
				expand: true,
				cwd: 'assets/src/sass/',
				src: ['*.scss'],
				dest: 'assets/dist/css/',
				ext: '.css'
			}]
		}
	},
	
	// Post Compilation of CSS
	postcss: {
		options: {
			map: false,
			processors: [
				require('autoprefixer')({browsers: 'last 3 versions'})
			]
		},
		dist: {
			src: ['assets/dist/css/*.css']
		}
	}
  })

  // Load all grunt tasks

  // LESS Compiler
  grunt.loadNpmTasks('grunt-contrib-less');
  //SASS Compiler
  grunt.loadNpmTasks('grunt-sass');
  //Post Compilation of CSS
  grunt.loadNpmTasks('grunt-postcss');
  // Watch File Changes
  grunt.loadNpmTasks('grunt-contrib-watch');
  // Compress JS Files
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // Include Files Within HTML
  grunt.loadNpmTasks('grunt-includes');
  // Optimize images
  grunt.loadNpmTasks('grunt-image');
  // Validate JS code
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-jscs');
  // Delete not needed files
  grunt.loadNpmTasks('grunt-contrib-clean');
  // Lint CSS
  grunt.loadNpmTasks('grunt-contrib-csslint');
  // Lint Bootstrap
  grunt.loadNpmTasks('grunt-bootlint');
  // Concatenate JS files
  grunt.loadNpmTasks('grunt-contrib-concat');
  // Notify
  grunt.loadNpmTasks('grunt-notify');
  // Replace
  grunt.loadNpmTasks('grunt-text-replace');
  // Copy Files
  grunt.loadNpmTasks('grunt-contrib-copy');
  // Linting task
  grunt.registerTask('lint', ['jshint', 'csslint', 'bootlint']);
  // JS task
  grunt.registerTask('js', ['copy', 'concat', 'uglify']);
  // CSS Task
  grunt.registerTask('css', ['image', 'sass','postcss']);

  // The default task (running 'grunt' in console) is 'watch'
  grunt.registerTask('default', ['watch']);
}