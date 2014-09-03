( function( $ ) {

	wp.customize( 'pandora_options-link_textcolor', function( value ) {
		value.bind( function( newval ) {
			if(newval){
				outcss = [ 
					//Background-color
					"button,input.send,input[type='submit'] , .hexagon .inner , .colorblock , .storebutton:hover , .iconmenu, .mainmenu , .appsblock .apps .slider .navigation:hover , .priceblock .block-container .pricetable .priceitem , .contactsblock .input-container input[type='submit'], .blogblock .navigation .page-numbers.current, .mainmenu .menuwrapper .menulist ul li ul li, .contactsblock .block-container .wrapper .contact-info a:hover, .contactsblock .block-container .wrapper .mailbutton.active { background-color: " + newval + ";}",

					"*::selection,input::selection,textarea::selection { background-color: " + newval + ";}",

					//Text color
					"a , .whiteblock a , .socialblock .socialicon i:hover , .skillsblock .skillcontainer:hover .skillogo .logocontainer , .skillsblock .skillcontainer:hover .title , .blogblock .block-container .post .post-body .title a:hover , .blogblock .block-container .post .meta .type i:hover { color: " + newval + ";}",

					//Border-color
					"input:focus,textarea:focus , .skillsblock .skillcontainer .wrapper .skillogo .logocontainer , .teamblock .block-container .teamcontainer .personal:hover .photo, .contactsblock .block-container .wrapper .mailbutton.active , .contactsblock .block-container .wrapper .mailbutton:hover { border-color: " + newval + ";}",

					".hexagon .inner:before {border-color: transparent transparent " + newval + " transparent; }",

					".hexagon .inner:after {border-color: " + newval + " transparent transparent transparent; }",

					".skillsblock .skillcontainer:hover .skillogo .logocontainer , .teamblock .block-container .teamcontainer .personal .photo { border-color: #c8c8c8; }",

					".comments .commentlist .comment-article:hover .comment-block img { box-shadow: 0 0 0 3px #fff, 0 0 0 6px " + newval + ";}"
				];

				$("#dynstyles").text(outcss.join('\n'));
			}
		} );
	} );
	
} )( jQuery );