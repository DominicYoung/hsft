define('components/zepto/main', function(require, exports, module) {

  require('components/zepto/event');
  require('components/zepto/ajax');
  require('components/zepto/form');
  require('components/zepto/touch');
  module.exports = require('components/zepto/zepto');
  

});
