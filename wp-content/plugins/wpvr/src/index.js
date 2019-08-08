const { __ } = wp.i18n; // Import __() from wp.i18n
const { Component } = wp.element;
var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    TextControl = wp.components.TextControl,
    SelectControl = wp.components.SelectControl,
    InspectorControls = wp.editor.InspectorControls,
    blockStyle = { fontFamily:'Roboto', backgroundColor: '#900', color: '#fff', padding: '20px' };

const iconEl = el('svg', { width: 20, height: 20 },
  el('path', { d: "M16.1,16.6h-2.5c-1,0-1.9-0.6-2.4-1.5L11,14.5c-0.2-0.4-0.5-0.6-0.9-0.6c-0.4,0-0.8,0.2-0.9,0.6l-0.3,0.6 c-0.4,0.9-1.3,1.5-2.4,1.5H3.9c-2.2,0-3.9-1.8-3.9-3.9V7.3c0-2.2,1.8-3.9,3.9-3.9h12.2c2.2,0,3.9,1.8,3.9,3.9v1.5 c0,0.4-0.3,0.8-0.8,0.8c-0.4,0-0.8-0.3-0.8-0.8V7.3c0-1.3-1.1-2.3-2.3-2.3H3.9C2.6,4.9,1.6,6,1.6,7.3v5.4c0,1.3,1.1,2.3,2.3,2.3 h2.6c0.4,0,0.8-0.2,0.9-0.6l0.3-0.6c0.4-0.9,1.3-1.5,2.4-1.5c1,0,1.9,0.6,2.4,1.5l0.3,0.6c0.2,0.4,0.5,0.6,0.9,0.6h2.5 c1.3,0,2.3-1.1,2.3-2.3c0-0.4,0.3-0.8,0.8-0.8c0.4,0,0.8,0.3,0.8,0.8C20,14.9,18.2,16.6,16.1,16.6L16.1,16.6z M16.7,9.4 c0-1.3-1.1-2.3-2.3-2.3C13,7.1,12,8.1,12,9.4s1.1,2.3,2.3,2.3C15.6,11.7,16.7,10.7,16.7,9.4L16.7,9.4z M15.1,9.4 c0,0.4-0.4,0.8-0.8,0.8c-0.4,0-0.8-0.4-0.8-0.8s0.4-0.8,0.8-0.8C14.8,8.6,15.1,9,15.1,9.4L15.1,9.4z M8,9.4C8,8.1,7,7.1,5.7,7.1 S3.3,8.1,3.3,9.4s1.1,2.3,2.3,2.3S8,10.7,8,9.4L8,9.4z M6.4,9.4c0,0.4-0.4,0.8-0.8,0.8c-0.4,0-0.8-0.4-0.8-0.8s0.4-0.8,0.8-0.8 C6.1,8.6,6.4,9,6.4,9.4L6.4,9.4z M6.4,9.4" } )
);
class wpvredit extends Component {

      constructor() {
        super( ...arguments );

        this.state = {
            data: [{value: "0", label: "None"}],
          };
      }

    componentDidMount() {
		wp.apiFetch( { path : 'wpvr/v1/panodata' } ).then( data => {
        this.setState( { data, data } );
    } );
	}

    render() {

            return [
            el( InspectorControls, {},
                el( SelectControl, {
                    label: 'Id',
                    value: this.props.attributes.id,

                    onChange: ( value ) => {
                        this.props.setAttributes( { id: value } );
                    },
                    options: this.state.data,
                } )
            ),
            el( InspectorControls, {},
                el( TextControl, {
                    label: 'Width',
                    value: this.props.attributes.width,
                    onChange: ( value ) => { this.props.setAttributes( { width: value } ); },
                } )
            ),
            el( InspectorControls, {},
                el( TextControl, {
                    label: 'Height',
                    value: this.props.attributes.height,
                    onChange: ( value ) => { this.props.setAttributes( { height: value } ); },
                } )
            ),

            el( InspectorControls, {},
                el( TextControl, {
                    label: 'Radius',
                    value: this.props.attributes.radius,
                    onChange: ( value ) => { this.props.setAttributes( { radius: value } ); },
                } )
            ),

            <p className="wpvr-block-content">
                WPVR id={this.props.attributes.id}, Width={this.props.attributes.width}px, Height={this.props.attributes.height}px, Radius={this.props.attributes.radius}px
            </p>

        ];

      }
}
registerBlockType( 'wpvr/wpvr-block', {
    title: 'WPVR',
    icon: iconEl,
    category: 'common',


    edit: wpvredit,

    save: function(props) {
        return null;
    },
} );
