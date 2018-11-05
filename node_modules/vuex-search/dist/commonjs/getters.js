'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = require('babel-runtime/helpers/defineProperty');

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _getterTypes$resource;

var _getterTypes = require('./getter-types');

var getterTypes = _interopRequireWildcard(_getterTypes);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = (_getterTypes$resource = {}, (0, _defineProperty3.default)(_getterTypes$resource, getterTypes.resourceIndexByName, function (state) {
  return function (resourceName) {
    return state[resourceName];
  };
}), (0, _defineProperty3.default)(_getterTypes$resource, getterTypes.isSearchingByName, function (state) {
  return function (resourceName) {
    return state[resourceName].isSearching;
  };
}), (0, _defineProperty3.default)(_getterTypes$resource, getterTypes.resultByName, function (state) {
  return function (resourceName) {
    return state[resourceName].result;
  };
}), _getterTypes$resource);