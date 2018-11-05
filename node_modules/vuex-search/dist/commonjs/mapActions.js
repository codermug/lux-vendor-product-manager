'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _values = require('babel-runtime/core-js/object/values');

var _values2 = _interopRequireDefault(_values);

var _utils = require('./utils');

var _VuexSearch = require('./VuexSearch');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * Generate actions with transformed payload for simpler api.
 *
 * @param {String} resourceName Unique resource identifier defined in the plugin.
 * @param {Object|Array} actions Object mapping from intented method name to actionType;
 *    or an array of actionTypes.
 * @return {Object}
 */
exports.default = function (resourceName, actions) {
  var res = {};
  var publicApiTypes = (0, _values2.default)(_VuexSearch.publicApi);

  (0, _utils.normalizeMap)(actions).forEach(function (_ref) {
    var key = _ref.key,
        val = _ref.val;

    if (!publicApiTypes.includes(val) && process.env.NODE_ENV !== 'production') {
      throw new Error('unknown actionType \'' + val + '\' is passed to mapActions');
    }

    res[key] = function mappedAction() {
      var vuexSearch = this.$store.search;

      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      return vuexSearch[val].apply(vuexSearch, [resourceName].concat(args));
    };
  });

  return res;
};