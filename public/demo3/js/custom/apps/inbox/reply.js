(()=>{"use strict";var e,t,a,n,o,r=(e=function(e){var t=e.querySelector('[data-kt-inbox-form="cc"]'),a=e.querySelector('[data-kt-inbox-form="cc_button"]'),n=e.querySelector('[data-kt-inbox-form="cc_close"]'),o=e.querySelector('[data-kt-inbox-form="bcc"]'),r=e.querySelector('[data-kt-inbox-form="bcc_button"]'),i=e.querySelector('[data-kt-inbox-form="bcc_close"]');a.addEventListener("click",(function(e){e.preventDefault(),t.classList.remove("d-none"),t.classList.add("d-flex")})),n.addEventListener("click",(function(e){e.preventDefault(),t.classList.add("d-none"),t.classList.remove("d-flex")})),r.addEventListener("click",(function(e){e.preventDefault(),o.classList.remove("d-none"),o.classList.add("d-flex")})),i.addEventListener("click",(function(e){e.preventDefault(),o.classList.add("d-none"),o.classList.remove("d-flex")}))},t=function(e){var t=e.querySelector('[data-kt-inbox-form="send"]');t.addEventListener("click",(function(){t.setAttribute("data-kt-indicator","on"),setTimeout((function(){t.removeAttribute("data-kt-indicator")}),3e3)}))},a=function(e){var t,a=new Tagify(e,{tagTextProp:"name",enforceWhitelist:!0,skipInvalid:!0,dropdown:{closeOnSelect:!1,enabled:0,classname:"users-list",searchKeys:["name","email"]},templates:{tag:function(e){return'\n                <tag title="'.concat(e.title||e.email,"\"\n                        contenteditable='false'\n                        spellcheck='false'\n                        tabIndex=\"-1\"\n                        class=\"").concat(this.settings.classNames.tag," ").concat(e.class?e.class:"",'"\n                        ').concat(this.getAttributes(e),">\n                    <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n                    <div class=\"d-flex align-items-center\">\n                        <div class='tagify__tag__avatar-wrap ps-0'>\n                            <img onerror=\"this.style.visibility='hidden'\" class=\"rounded-circle w-25px me-2\" src=\"").concat(hostUrl,"media/").concat(e.avatar,"\">\n                        </div>\n                        <span class='tagify__tag-text'>").concat(e.name,"</span>\n                    </div>\n                </tag>\n            ")},dropdownItem:function(e){return"\n                <div ".concat(this.getAttributes(e),"\n                    class='tagify__dropdown__item d-flex align-items-center ").concat(e.class?e.class:"",'\'\n                    tabindex="0"\n                    role="option">\n\n                    ').concat(e.avatar?'\n                            <div class=\'tagify__dropdown__item__avatar-wrap me-2\'>\n                                <img onerror="this.style.visibility=\'hidden\'"  class="rounded-circle w-50px me-2" src="'.concat(hostUrl,"media/").concat(e.avatar,'">\n                            </div>'):"",'\n\n                    <div class="d-flex flex-column">\n                        <strong>').concat(e.name,"</strong>\n                        <span>").concat(e.email,"</span>\n                    </div>\n                </div>\n            ")}},whitelist:[{value:1,name:"Emma Smith",avatar:"avatars/300-6.jpg",email:"e.smith@kpmg.com.au"},{value:2,name:"Max Smith",avatar:"avatars/300-1.jpg",email:"max@kt.com"},{value:3,name:"Sean Bean",avatar:"avatars/300-5.jpg",email:"sean@dellito.com"},{value:4,name:"Brian Cox",avatar:"avatars/300-25.jpg",email:"brian@exchange.com"},{value:5,name:"Francis Mitcham",avatar:"avatars/300-9.jpg",email:"f.mitcham@kpmg.com.au"},{value:6,name:"Dan Wilson",avatar:"avatars/300-23.jpg",email:"dam@consilting.com"},{value:7,name:"Ana Crown",avatar:"avatars/300-12.jpg",email:"ana.cf@limtel.com"},{value:8,name:"John Miller",avatar:"avatars/300-13.jpg",email:"miller@mapple.com"}]});a.on("dropdown:show dropdown:updated",(function(e){var n=e.detail.tagify.DOM.dropdown.content;a.suggestedListItems.length>1&&(t=a.parseTemplate("dropdownItem",[{class:"addAll",name:"Add all",email:a.settings.whitelist.reduce((function(e,t){return a.isTagDuplicate(t.value)?e:e+1}),0)+" Members"}]),n.insertBefore(t,n.firstChild))})),a.on("dropdown:select",(function(e){e.detail.elm==t&&a.dropdown.selectAll.call(a)}))},n=function(e){new Quill("#kt_inbox_form_editor",{modules:{toolbar:[[{header:[1,2,!1]}],["bold","italic","underline"],["image","code-block"]]},placeholder:"Type your text here...",theme:"snow"});var t,a=e.querySelector(".ql-toolbar");a&&(t=a.classList).add.apply(t,["px-5","border-top-0","border-start-0","border-end-0"])},o=function(e){var t='[data-kt-inbox-form="dropzone"]',a=e.querySelector(t),n=e.querySelector('[data-kt-inbox-form="dropzone_upload"]'),o=a.querySelector(".dropzone-item");o.id="";var r=o.parentNode.innerHTML;o.parentNode.removeChild(o);var i=new Dropzone(t,{url:"https://preview.keenthemes.com/api/dropzone/void.php",parallelUploads:20,maxFilesize:1,previewTemplate:r,previewsContainer:t+" .dropzone-items",clickable:n});i.on("addedfile",(function(e){a.querySelectorAll(".dropzone-item").forEach((function(e){e.style.display=""}))})),i.on("totaluploadprogress",(function(e){a.querySelectorAll(".progress-bar").forEach((function(t){t.style.width=e+"%"}))})),i.on("sending",(function(e){a.querySelectorAll(".progress-bar").forEach((function(e){e.style.opacity="1"}))})),i.on("complete",(function(e){var t=a.querySelectorAll(".dz-complete");setTimeout((function(){t.forEach((function(e){e.querySelector(".progress-bar").style.opacity="0",e.querySelector(".progress").style.opacity="0"}))}),300)}))},{init:function(){var r,i;document.querySelectorAll('[data-kt-inbox-message="message_wrapper"]').forEach((function(e){var t=e.querySelector('[data-kt-inbox-message="header"]'),a=e.querySelector('[data-kt-inbox-message="preview"]'),n=e.querySelector('[data-kt-inbox-message="details"]'),o=e.querySelector('[data-kt-inbox-message="message"]'),r=new bootstrap.Collapse(o,{toggle:!1});t.addEventListener("click",(function(e){e.target.closest('[data-kt-menu-trigger="click"]')||e.target.closest(".btn")||(a.classList.toggle("d-none"),n.classList.toggle("d-none"),r.toggle())}))})),r=document.querySelector("#kt_inbox_reply_form"),i=r.querySelectorAll('[data-kt-inbox-form="tagify"]'),e(r),t(r),i.forEach((function(e){a(e)})),n(r),o(r)}});KTUtil.onDOMContentLoaded((function(){r.init()}))})();