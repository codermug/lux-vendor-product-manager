'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = plugin;

var _VuexSearch = require('./VuexSearch');

var _VuexSearch2 = _interopRequireDefault(_VuexSearch);

var _SearchApi = require('./SearchApi');

var _SearchApi2 = _interopRequireDefault(_SearchApi);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * Vuex binding for client-side search with indexer and Web Workers
 *
 * @param {[resourceName: string]: { getter, indexes, searchApi? }} resources
 *    Resource to watch and index
 * @param {SearchApi} searchApi Optional, can also use custom SearchApi instances
 */
function plugin() {
  var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
      _ref$resources = _ref.resources,
      resources = _ref$resources === undefined ? {} : _ref$resources,
      _ref$searchApi = _ref.searchApi,
      searchApi = _ref$searchApi === undefined ? new _SearchApi2.default() : _ref$searchApi;

  return function (store) {
    /* eslint-disable no-new */
    new _VuexSearch2.default({ store: store, resources: resources, searchApi: searchApi });
  };
}