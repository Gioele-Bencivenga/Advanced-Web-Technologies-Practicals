'use strict';

//import { LikeButton } from "like_button.js";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var HobbyCard = function (_React$Component) {
  _inherits(HobbyCard, _React$Component);

  function HobbyCard(props) {
    _classCallCheck(this, HobbyCard);

    var _this = _possibleConstructorReturn(this, (HobbyCard.__proto__ || Object.getPrototypeOf(HobbyCard)).call(this, props));

    _this.state = { clicked: false };
    return _this;
  }

  _createClass(HobbyCard, [{
    key: 'onClick',
    value: function onClick() {
      this.state.clicked = true;
    }
  }, {
    key: 'render',
    value: function render() {
      // default style
      var cardStyle = {
        backgroundColor: 'white'
      };

      if (this.state.clicked == true) {
        // clicked style
        cardStyle = {
          backgroundColor: 'red'
        };
      }

      return React.createElement(
        'div',
        { className: 'card', style: cardStyle, onClick: this.onClick.bind(this) },
        React.createElement('img', { src: 'images/rock-climbing.jpg', className: 'card-img-top',
          alt: 'Image of rock climber\'s silhouette against the sunset.' }),
        React.createElement(
          'div',
          { className: 'card-body' },
          React.createElement(
            'h5',
            { className: 'card-title' },
            'Card Title'
          ),
          React.createElement(
            'p',
            { className: 'card-text' },
            'Card Description.'
          ),
          React.createElement(
            'a',
            { href: '#', className: 'btn btn-primary' },
            'Card Action'
          )
        ),
        React.createElement(
          'div',
          { className: 'card-footer' },
          React.createElement('div', { className: 'like_button_container' })
        )
      );
    }
  }]);

  return HobbyCard;
}(React.Component);

// Find all DOM containers, and render Like buttons into them.


document.querySelectorAll('.hobby_card_container').forEach(function (domContainer) {
  ReactDOM.render(React.createElement(HobbyCard, null), domContainer);
});