'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = require('babel-runtime/helpers/defineProperty');

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _mutationTypes$SET_IN;

var _vue = require('vue');

var _vue2 = _interopRequireDefault(_vue);

var _mutationTypes = require('./mutation-types');

var mutationTypes = _interopRequireWildcard(_mutationTypes);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = (_mutationTypes$SET_IN = {}, (0, _defineProperty3.default)(_mutationTypes$SET_IN, mutationTypes.SET_INIT_RESOURCE, function (state, _ref) {
  var resourceName = _ref.resourceName;

  _vue2.default.set(state, resourceName, {
    isSearching: false,
    text: '',
    result: []
  });
}), (0, _defineProperty3.default)(_mutationTypes$SET_IN, mutationTypes.SET_SEARCH_RESULT, function (state, _ref2) {
  var resourceName = _ref2.resourceName,
      result = _ref2.result,
      text = _ref2.text;

  _vue2.default.set(state, resourceName, {
    isSearching: false,
    text: text,
    result: result
  });
}), (0, _defineProperty3.default)(_mutationTypes$SET_IN, mutationTypes.SET_SEARCH, function (state, _ref3) {
  var resourceName = _ref3.resourceName,
      searchString = _ref3.searchString;

  _vue2.default.set(state[resourceName], 'text', searchString);
  _vue2.default.set(state[resourceName], 'isSearching', true);
}), (0, _defineProperty3.default)(_mutationTypes$SET_IN, mutationTypes.DELETE_RESOURCE, function (state, _ref4) {
  var resourceName = _ref4.resourceName;

  _vue2.default.delete(state, resourceName);
}), _mutationTypes$SET_IN);