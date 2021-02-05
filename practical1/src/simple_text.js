'use strict';

class SimpleText extends React.Component {
    constructor(props) {
        super(props);
        this.state = { textToDisplay: props.textToDisplay };
    }

    render() {
        return "Simple Text!";
    }
}

let domContainer = document.querySelector('#simple_text_container');
ReactDOM.render(<SimpleText />, domContainer);