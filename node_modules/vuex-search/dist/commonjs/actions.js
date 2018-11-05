'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = require('babel-runtime/helpers/defineProperty');

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

exports.default = actionsWithSearch;

var _mutationTypes = require('./mutation-types');

var mutationTypes = _interopRequireWildcard(_mutationTypes);

var _actionTypes = require('./action-types');

var actionTypes = _interopRequireWildcard(_actionTypes);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * Actions with injected search API mapper.
 *
 * @param {{ [resourceName: string]: Search }} searchMap mapper of each resources searchApi
 */
function actionsWithSearch(searchMap) {
  var _ref6;

  return _ref6 = {}, (0, _defineProperty3.default)(_ref6, actionTypes.RECEIVE_RESULT, function (_ref, _ref2) {
    var commit = _ref.commit;
    var resourceName = _ref2.resourceName,
        result = _ref2.result,
        text = _ref2.text;

    commit(mutationTypes.SET_SEARCH_RESULT, {
      resourceName: resourceName,
      result: result,
      text: text
    });
  }), (0, _defineProperty3.default)(_ref6, actionTypes.searchApi.INDEX_RESOURCE, function (_, params) {
    var resourceName = params.resourceName;

    searchMap[resourceName].indexResource(params);
  }), (0, _defineProperty3.default)(_ref6, actionTypes.searchApi.PERFORM_SEARCH, function (_, _ref3) {
    var resourceName = _ref3.resourceName,
        searchString = _ref3.searchString;

    searchMap[resourceName].stopSearch(resourceName);
    searchMap[resourceName].performSearch(resourceName, searchString);
  }), (0, _defineProperty3.default)(_ref6, actionTypes.SEARCH, function (_ref4, _ref5) {
    var commit = _ref4.commit,
        dispatch = _ref4.dispatch;
    var resourceName = _ref5.resourceName,
        searchString = _ref5.searchString;

    commit(mutationTypes.SET_SEARCH, { resourceName: resourceName, searchString: searchString });
    dispatch(actionTypes.searchApi.PERFORM_SEARCH, { resourceName: resourceName, searchString: searchString });
  }), _ref6;
}