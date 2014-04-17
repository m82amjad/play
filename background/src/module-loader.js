/*
  background.js 0.3.3
  (c) 2011, 2012 Kevin Malakoff - http://kmalakoff.github.com/background/
  License: MIT (http://www.opensource.org/licenses/mit-license.php)
*/
(function() {
  return (function(factory) {
    // AMD
    if (typeof define === 'function' && define.amd) {
      return define('background', factory);
    }
    // CommonJS/NodeJS or No Loader
    else {
      return factory.call(this);
    }
  })(function() {'__REPLACE__'; return Background;});
}).call(this);