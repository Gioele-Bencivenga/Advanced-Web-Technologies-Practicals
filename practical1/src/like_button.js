'use strict';

class LikeButton extends React.Component {
  constructor(props) {
    super(props);

    this.state = { likesAmount: 0 };
  }

  onClick() {
    this.setState(prevState => {
      return { likesAmount: prevState.likesAmount + 1 };
    });
  }

  render() {
    // default style
    var btnStyle = {
      backgroundColor: 'white'
    }

    if (this.state.likesAmount > 0) {
      // liked style
      btnStyle = {
        backgroundColor: '#b3ffb3'
      }

      return (
        <button 
        onClick={this.onClick.bind(this)} style={btnStyle}>
          Liked <small>{this.state.likesAmount} times!</small>
        </button>
      );
    }

    return (
      <button onClick={this.onClick.bind(this)} style={btnStyle}>
        Like
      </button>
    );
  }
}

let domContainer = document.querySelector('.like_button_container');
ReactDOM.render(<LikeButton />, domContainer);