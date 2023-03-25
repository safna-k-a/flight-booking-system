/**
* Template Name: NiceAdmin
* Updated: Mar 09 2023 with Bootstrap v5.2.3
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate quill editors
   */
  if (select('.quill-editor-default')) {
    new Quill('.quill-editor-default', {
      theme: 'snow'
    });
  }

  if (select('.quill-editor-bubble')) {
    new Quill('.quill-editor-bubble', {
      theme: 'bubble'
    });
  }

  if (select('.quill-editor-full')) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [{
            font: []
          }, {
            size: []
          }],
          ["bold", "italic", "underline", "strike"],
          [{
              color: []
            },
            {
              background: []
            }
          ],
          [{
              script: "super"
            },
            {
              script: "sub"
            }
          ],
          [{
              list: "ordered"
            },
            {
              list: "bullet"
            },
            {
              indent: "-1"
            },
            {
              indent: "+1"
            }
          ],
          ["direction", {
            align: []
          }],
          ["link", "image", "video"],
          ["clean"]
        ]
      },
      theme: "snow"
    });
  }

  /**
   * Initiate TinyMCE Editor
   */
  const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

  tinymce.init({
    selector: 'textarea.tinymce-editor',
    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
    editimage_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    toolbar_sticky_offset: isSmallScreen ? 102 : 108,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_class_list: [{
        title: 'None',
        value: ''
      },
      {
        title: 'Some class',
        value: 'class-name'
      }
    ],
    importcss_append: true,
    file_picker_callback: (callback, value, meta) => {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', {
          text: 'My text'
        });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', {
          alt: 'My alt text'
        });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', {
          source2: 'alt.ogg',
          poster: 'https://www.google.com/logos/google.jpg'
        });
      }
    },
    templates: [{
        title: 'New Table',
        description: 'creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
      },
      {
        title: 'Starting my story',
        description: 'A cure for writers block',
        content: 'Once upon a time...'
      },
      {
        title: 'New list with dates',
        description: 'New List with dates',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
      }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

  /**
   * Initiate Datatables
   */
  const datatables = select('.datatable', true)
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable);
  })

  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function() {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }

})();

// Author : ANJALI SOMAN
function fvalidate()
{
    let fname=document.getElementById("flight_name").value;
    let da=document.getElementById("departure_a").value;
    let aa=document.getElementById("arrival_a").value;
    let dd=document.getElementById("departure_date").value;
    let ad=document.getElementById("arrival_date").value;
    let dt=document.getElementById("departure_time").value;
    let at=document.getElementById("arrival_time").value;
    var vardDate = new Date(dd); //dd-mm-YYYY
    var varaDate = new Date(ad); 
    var today = new Date();
    today.setHours(0, 0, 0, 0);
    if(fname=="")
    {
        alert("Flight Name cannot be empty!");
        return false();
    }
    else if(da=="")
    {
        alert("Choose a departure destination!");
        return false;
    }
    else if(aa=="")
    {
        alert("Choose an arrival destination!");
        return false;
    }
    else if(dd=="")
    {
        alert("Choose a  departure date");
        return false;
    }
    else if(ad=="")
    {
        alert("Choose an arrival date!");
        return false;
    }
    else if(dt=="")
    {
        alert("Choose a departure date!");
        return false;
    }
    else if (!(vardDate >= today)) {
        alert("Please select a departure date after today!");
        return false;
    }
    else if(at=="")
    {
        alert("Choose an arrival date!")
        return false;
    }
    else if (!(varaDate >= today)) {
        alert("Please select an arrival date after today!");
        return false;
    }
    else{
        return true;
    }
}

  // author:JOMOL GEORGE
// Date:19-03-2023
//airport-add 
    function airport_validate() {
    let air = document.getElementById("name").value;
    let abr = document.getElementById("abbr").value;
    let state = document.getElementById("state_id").value;
    let u_abr=abr.toUpperCase();
    document.getElementById("abbr").value=u_abr;
    let abrlen=u_abr.length;
    
    if (air == "") {
        document.getElementById("name").innerHTML;
        alert("Airportname cannot be empty!");
        return false;
    } 
    else if (abr == "") {
        document.getElementById("abbr").innerHTML;
        alert("enter the abbriviation ");
        return false;
    }
    else if(abrlen<=3){
        document.getElementById("abbr").innerHTML;
        alert("please enter 3 alphabets");
        return false;
    }
    else if(abrlen>=3){
        document.getElementById("abbr").innerHTML;
        alert("can't eneter more than 3 alphabets ");
        return false;
    }
    else if (state == "") {
        document.getElementById("state_id").innerHTML;
        alert("select the state");
        return false;
    }
    
 else {
        return true;
    }
        
    }  
    
        
    
// author:JOMOL GEORGE
// Date:19-03-2023
//flight-add     

function flight_validate(){
    let flight = document.getElementById("name").value;
    let id = document.getElementById("airline_id").value;
    let seat = document.getElementById("total_seat").value;
    if (flight == "") {
        document.getElementById("name").innerHTML;
        alert("Flight name cannot be empty!");
        return false;
    }
    else if (id == "") {
        document.getElementById("arline_id").innerHTML;
        alert("choose the airline");
        return false;
    }
    else if (seat == "") {
        document.getElementById("total_seat").innerHTML;
        alert("Enter the seat count");
        return false;
    }
    
 else {
        return true;
    }
        
    }
    
    
    
    // author:JOMOL GEORGE
// Date:19-03-2023
//fare-add 
    function fare_validate() {
    let fly = document.getElementById("fly_id").value;
    let e_rate = document.getElementById("economy_rate").value;
    let b_rate = document.getElementById("business_rate").value;
    if (fly == "") {
        document.getElementById("fly_id").innerHTML;
        alert("please add the flightname");
        return false;
    } 
    else if (e_rate == "") {
        document.getElementById("economy_rate").innerHTML;
        alert("add economy class rate");
        return false;
    }
    
    else if (b_rate == "") {
        document.getElementById("business_rate").innerHTML;
        alert("add business class rate");
        return false;
    }
    
 else {
        return true;
    }
        
    }  
    