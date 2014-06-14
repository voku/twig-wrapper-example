/**
 * # Grunt
 * A task manager for auto compiling and validating code
 *
 * ## Set up
 * Make sure the you have nodejs running on your machine
 * Install Grunt with npm `npm install -g grunt-cli`
 * Install Grunt packages `npm install`
 *
 * ## Config
 * The configuration settings are found in `package.json`.
 *
 * ## Running
 * You can type `grunt <command>` to run any of rules in the `initConfig` function
 * e.g. `grunt compass` to compile the scss files to css
 *
 * You can also run a sub-task by adding `:<subtask>`
 * e.g. `grunt uglify:js` to compile to javaScript header file
 *
 * ## Helper Commands
 * There are a number of helper command at the end of the file
 * - default (`grunt`) will watch the folder and compile when files are saved
 */

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {
  'use strict';

  // require it at the top and pass in the grunt instance
  require('time-grunt')(grunt);

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    meta: {
      banner: '/*\n' +
      ' * app <%= pkg.version %> by <%= pkg.author %> (<%= grunt.template.today("yyyy-mm-dd, HH:MM") %>)\n' +
      ' */'
    },

    clean: {
      build: ["js-min/*", "css/*", "css-min/*"]
    },

    uglify: {
      js: {
        options: {
          banner: '<%= meta.banner %>\n',
          sourceMap: true
        },
        files: [
          {
            expand: true,
            cwd: 'js/',
            src: '**/*.js',
            dest: 'js-min/'
          }
        ]
      }
    },

    jshint: {
      options: {
        "node": true,
        "esnext": true,
        "bitwise": true,
        "curly": true,
        "eqeqeq": true,
        "immed": true,
        "latedef": true,
        "newcap": true,
        "noarg": true,
        "regexp": true,
        "undef": false,
        "unused": false,
        "globals": {
          "$": false,
          "jquery": false,
          "jQuery": false,
          "Modernizr": false,
          "console": false,
          "require": false,
          "process": false,
          "__dirname": false,
          "exports": false,
          "angular": false,
          "document": false,
          "head": false,
          "module": false,
          "window": false,
          "navigator": false
        }
      },
      files: ['Gruntfile.js', 'js/*.js']
    },

    compass: {
      dist: {
        options: {
          config: 'config.rb',
          sourcemap: true
        }
      }
    },

    csscomb: {
      dist: {
        expand: true,
        cwd: 'css/',
        src: ['*.css'],
        dest: 'css/',
        ext: '.css'
      }
    },

    cssmin: {
      options: {
        keepSpecialComments: 0,
        banner: '<%= meta.banner %>\n'
      },
      minify: {
        expand: true,
        cwd: 'css/',
        src: ['*.css'],
        dest: 'css-min/'
      }
    },

    imagemin: {                          // Task
      options: {
        cache: false
      },
      dynamic: {                         // Another target
        files: [
          {
            expand: true,                  // Enable dynamic expansion
            cwd: 'images/',                // Src matches are relative to this path
            src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
            dest: 'images/'                // Destination path prefix
          }
        ]
      }
    },

    dalek: {
      options: {
        // invoke phantomjs, chrome & chrome canary ...
        browser: ['phantomjs'],
        // generate an html & an jUnit report
        reporter: ['html', 'junit']
      },
      dist: {
        src: ['tests/dalek/*.js']
      }
    },

    autoprefixer: {
      options: {
        browsers: ['last 100 version']
      },
      multiple_files: {
        expand: true,
        flatten: true,
        src: 'css/*.css',
        dest: 'css/'
      }
    },

    watch: {

      twig: {
        files: ['*.twig'],
        options: {
          livereload: true
        }
      },

      js: {
        files: ['js/*.js'],
        tasks: ['uglify:js', 'jshint'],
        options: {
          livereload: true
        }
      },

      sass: {
        files: ['scss/*.scss'],
        tasks: ['compass:dist', 'autoprefixer', 'csscomb:dist', 'cssmin:minify'],
        options: {
          livereload: true,
          spawn: false       // for grunt-contrib-watch v0.5.0+, "nospawn: true" for lower versions.
        }
      }

    }

  });

  // load all plugins from the "package.json"-file
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  grunt.registerTask('default', ['watch']);

  grunt.registerTask('clean-build', ['clean:build']);
  grunt.registerTask('cssmin' ['cssmin:minify']);
  grunt.registerTask('csscomb' ['csscomb:dist']);
  grunt.registerTask('image-min', ['imagemin:dynamic']);
  grunt.registerTask('test', ['dalek']);

  grunt.registerTask(
      'build',
      'Build this website ... yeaahhh!',
      [ 'clean:build', 'uglify:js', 'jshint', 'compass:dist', 'autoprefixer', 'csscomb:dist', 'cssmin:minify' ]
  );

};
