'use strict';

//import { LikeButton } from "like_button.js";

class HobbyCard extends React.Component {
  constructor(props) {
    super(props);

    this.state = { clicked: false };
  }

  onClick() {
    this.state.clicked = true;
  }

  render() {
    // default style
    var cardStyle = {
      backgroundColor: 'white'
    }

    if (this.state.clicked == true) {
      // clicked style
      cardStyle = {
        backgroundColor: 'red'
      }
    }

    return (
      <div className="card" style={cardStyle} onClick={this.onClick.bind(this)} >
        <img src="images/rock-climbing.jpg" className="card-img-top"
          alt="Image of rock climber's silhouette against the sunset." />
        <div className="card-body">
          <h5 className="card-title">Card Title</h5>
          <p className="card-text">Card Description.</p>
          <a href="#" className="btn btn-primary">Card Action</a>
        </div>
        <div className="card-footer">
          <div className="like_button_container"></div>
        </div>
      </div>
    );
  }
}

// Find all DOM containers, and render Like buttons into them.
document.querySelectorAll('.hobby_card_container').forEach(domContainer => {
  ReactDOM.render(<HobbyCard />, domContainer);
});