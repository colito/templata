<style type="text/css">

        /*
            Generally, all CSS in an email should be inlined. Because it
            can be tedious to adjust email styling after inlining has
            been done, it's easier to write all CSS in the <head>, then
            use a CSS inliner to inline the styles once you've finished.

            MailChimp provides a stand-alone CSS inliner at
            http://beaker.mailchimp.com/inline-css
        */

        /*////// RESET STYLES //////*/
    body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}
    table{border-collapse:collapse;}
    img, a img{border:0; outline:none; text-decoration:none;}
    h1, h2, h3, h4, h5, h6{margin:0; padding:0;}
    p{margin: 1em 0;}

        /*////// CLIENT-SPECIFIC STYLES //////*/
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
    #outlook a{padding:0;} /* Force Outlook 2007 and up to provide a "view in browser" message. */
    img{-ms-interpolation-mode: bicubic;} /* Force IE to smoothly render resized images. */
    body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */

        /*////// GENERAL STYLES //////*/
    h1, h2, h3{font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;}
    h1, h1 a{color:#D83826; font-size:44px; font-weight:100; line-height:115%; text-align:left;}
    h2, h2 a{color:#606060; font-size:34px; font-weight:100; line-height:100%; text-align:left;}
    h3, h3 a{color:#D83826; font-size:30px; font-weight:100; line-height:115%; text-align:left;}
    .introductionHeading, .introductionContent, .callToActionContent, .callToActionButtonContent, .eventBlockMonth, .eventBlockDay, .eventContent, .merchandiseContent, .merchandiseButtonContent, .footerContent{font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;}

    body, #bodyTable{background-color:#424145;}
    #emailContainer{width:100%;}

    #heroImageContainer{background-color:#F0F0F0;}

    #introductionContainer{background-color:#F0F0F0; padding:40px;}
    #introductionBlock{background-color:#F0F0F0;}
    .introductionHeading{color:#808080; font-size:14px; font-weight:bold; line-height:150%; padding-left:40px;}
    .introductionContent{color:#606060; font-size:18px; line-height:150%; padding-top:40px;}

    #callToActionContainer{background-color:#D83826; padding:40px;}
    #callToActionBlock{background-color:#D83826;}
    .callToActionContent h3{color:#FFFFFF; text-align:center;}
    .callToActionContent{color:#FFFFFF; font-size:16px; line-height:150%; padding-bottom:40px; text-align:center;}
    .callToActionButton{background-color:#F0F0F0; border-radius:4px; box-shadow:0 5px 0 #A22A1C;}
    .callToActionButtonContent{padding-top:20px; padding-right:40px; padding-bottom:20px; padding-left:40px;}
    .callToActionButtonContent, .callToActionButtonContent a{color:#D83826; display:block; font-size:24px; font-weight:bold; line-height:100%; letter-spacing:-1px; text-align:center; text-decoration:none;}

    #eventContainer{background-color:#F0F0F0; padding:40px;}
    #eventBlock{background-color:#F0F0F0; border-top:1px solid #BBBBBB; border-bottom:1px solid #BBBBBB;}
    #eventBlockCell{padding:40px;}
    .eventBlockCalendar{background-color:#FFFFFF; border:1px solid #DDDDDD;}
    .eventBlockHeading{padding-bottom:40px;}
    .eventBlockMonth{background-color:#D83826; color:#FFFFFF; font-size:18px; font-weight:bold; line-height:100%; padding:10px;}
    .eventBlockDay{background-color:#FFFFFF; color:#404040; font-size:48px; font-weight:bold; line-height:100%; padding:15px;}
    .eventContent{color:#606060; font-size:16px; line-height:125%; padding-left:20px;}

    #merchandiseContainer{background-color:#F0F0F0; padding-right:40px; padding-bottom:40px; padding-left:40px;}
    #merchandiseBlock{background-color:#FFFFFF; border:1px solid #BBBBBB; border-collapse:separate; border-radius:4px;}
    #merchandiseBlockCell{padding:40px;}
    .merchandiseBlockHeading{padding-bottom:40px;}
    .merchandiseBlockLeftColumn{padding-right:10px;}
    .merchandiseBlockRightColumn{padding-left:10px;}
    .merchandiseImage{border:1px solid #DDDDDD;}
    .merchandiseContent{color:#606060; font-size:16px; line-height:110%; padding-left:10px;}
    .merchandiseButton{background-color:#D83826; border-radius:4px; box-shadow:0 5px 0 #A22A1C}
    .merchandiseButtonContent, .merchandiseButtonContent a{color:#F0F0F0; font-size:16px; font-weight:bold; line-height:100%; letter-spacing:-1px; padding:10px; text-align:center; text-decoration:none;}

    #footerContainer{padding:40px;}
    .footerContent{color:#AAAAAA; font-size:13px; line-height:150%; padding-bottom:40px;}
    .footerContent a{color:#D83826; text-decoration:none;}

        /*////// MOBILE STYLES //////*/

        /*
            CSS selectors are written in attribute
            selector format to prevent Yahoo Mail
            from rendering media query styles on
            desktop.
        */

    @media only screen and (max-width: 480px){
        /*////// RESET STYLES //////*/
        td[id="introductionContainer"], td[id="callToActionContainer"], td[id="eventContainer"], td[id="merchandiseContainer"], td[id="footerContainer"]{padding-right:10px !important; padding-left:10px !important;}
        table[id="introductionBlock"], table[id="callToActionBlock"], table[id="eventBlock"], table[id="merchandiseBlock"], table[id="footerBlock"]{max-width:480px !important; width:100% !important;}

        /*////// CLIENT-SPECIFIC STYLES //////*/
        body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

        /*////// GENERAL STYLES //////*/
        h1{font-size:34px !important;}
        h2{font-size:30px !important;}
        h3{font-size:24px !important;}

        img[id="heroImage"]{height:auto !important; max-width:520px !important; width:100% !important;}

        td[class="introductionLogo"], td[class="introductionHeading"]{display:block !important;}
        td[class="introductionHeading"]{padding:40px 0 0 0 !important;}
        td[class="introductionContent"]{padding-top:20px !important;}

        td[class="callToActionContent"]{text-align:left !important;}
        table[class="callToActionButton"]{width:100% !important;}

        td[id="eventBlockCell"]{padding-right:20px !important; padding-left:20px !important;}
        table[class="eventBlockCalendar"]{width:100px !important;}

        td[id="merchandiseBlockCell"]{padding-right:20px !important; padding-left:20px !important;}
        td[class="merchandiseBlockHeading"] h2{text-align:center !important;}
        td[class="merchandiseBlockLeftColumn"], td[class="merchandiseBlockRightColumn"]{display:block !important; padding:0 0 20px 0 !important; width:100% !important;}

        td[class="footerContent"]{font-size:15px !important;}
        td[class="footerContent"] a{display:block;}
    }
</style>