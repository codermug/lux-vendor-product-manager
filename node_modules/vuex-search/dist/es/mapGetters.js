'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _utils = require('./utils');

/**
 * Generate getters with injected resourceName for simpler api.
 *
 * @param {String} [resourceName] Unique resource identifier defined in the plugin.
 * @param {Object|Array} actions Object mapping from intented method name to getterType;
 *    or an array of getterTypes.
 * @return {Object}
 */
exports.default = function (resourceName, getters) {
  var res = {};
  (0, _utils.normalizeMap)(getters).forEach(function (_ref) {
    var key = _ref.key,
        val = _ref.val;

    res[key] = function mappedGetter() {
      var namespace = (0, _utils.normalizeNamespaceName)(this.$store.search._base);
      return this.$store.getters['' + namespace + val](resourceName);
    };
  });

  return res;
};