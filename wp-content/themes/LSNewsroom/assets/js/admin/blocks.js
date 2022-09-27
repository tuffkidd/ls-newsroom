const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { RichText } = wp.editor
// const { addFilter } = wp.hooks;
// const { createHigherOrderComponent } = wp.compose;
// const { Fragment } = wp.element;
// const { InspectorControls } = wp.editor;
// const { InspectorAdvancedControls } = wp.editor;
// const { PanelBody, SelectControl, TextControl } = wp.components;

registerBlockType('wildworks-extend-block/video-subtitle', {
	title: '비디오 자막',
	icon: 'text',
	category: 'layout',
	attributes: {
		content: {
			type: 'array',
			source: 'children',
			selector: 'p'
		}
		/*tabindex: {
			type: 'string',
			source: 'attribute',
			selector: 'p',
			attribute: 'tabindex',
		},*/
	},
	// edit: ( props ) => {
	edit ({ attributes, setAttributes, className, isSelected }) {
		// const { attributes: { content }, setAttributes, className } = props;
		// const onChangeContent = ( newContent ) => {
		//     setAttributes( { content: newContent } );
		// };
		return (
			<div className={className}>
				<RichText
					tagName='p'
					className='video-subtitle'
					onChange={newContent => setAttributes({ content: newContent })}
					value={attributes.content}
					placeholder={__('비디오 자막을 입력하세요.')}
					keepPlaceholderOnFocus={true}
				/>
			</div>
		)
	},
	save (props) {
		return (
			<div class={props.className}>
				<a href='#' class='toggle-video-subtitle arrow-down'>
					자막 보기
				</a>
				<RichText.Content
					tagName='p'
					className='video-subtitle'
					tabindex='0'
					value={props.attributes.content}
				/>
			</div>
		)
	}
})

// registerBlockType('wildworks-extend-block/pressrelease-by-post', {
//   title: '관련 보도',
//   description: '포스팅 하단의 관련 보도에 사용됩니다.',
//   icon: 'editor-ul',
//   category: 'layout',
//   attributes: {
//     content: {
//       type: 'string',
//       source: 'html',
//       selector: 'ul'
//     }
//     // tabindex: {
//     // 	type: 'string',
//     // 	source: 'attribute',
//     // 	selector: 'p',
//     // 	attribute: 'tabindex',
//     // },
//   },
//   // edit: ( props ) => {
//   edit ({ attributes, setAttributes, className, isSelected }) {
//     // const { attributes: { content }, setAttributes, className } = props;
//     // const onChangeContent = ( newContent ) => {
//     //     setAttributes( { content: newContent } );
//     // };
//     return (
//       <div className={className}>
//         <h3>관련 보도</h3>
//         <RichText
//           tagName='ul'
//           multiline='li'
//           className='pressrelease-by-post'
//           onChange={newContent => setAttributes({ content: newContent })}
//           value={attributes.content}
//           placeholder={__('기사화 된 링크를 입력하세요.')}
//           keepPlaceholderOnFocus={true}
//         />
//       </div>
//     )
//   },
//   save (props) {
//     return (
//       <div class={props.className}>
//         <h3>관련 보도</h3>
//         <RichText.Content
//           tagName='ul'
//           multiline='li'
//           className='pressrelease-by-post'
//           tabindex='0'
//           value={props.attributes.content}
//         />
//       </div>
//     )
//   }
// })
