$(document).ready(function () {
  $('.menu-toggle').on('click', function () {
    $('.nav').toggleClass('showing');
    $('.nav ul').toggleClass('showing');
  });
  $('.post-wrapper').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});


ClassicEditor.create(document.querySelector("#body"), {
  toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
  heading: {
    options: [
      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
    ]
  }
})
.catch(error => {
  console.log(error);
});

function loadPosts(page) {
  var request = new XMLHttpRequest();
  request.open("GET", "posts_api.php?action=posts&page=" + page);

  request.onreadystatechange = function() {
      if(this.readyState === 4 && this.status === 200)  {
          let data = JSON.parse(this.responseText);
          let txt = "";
          let row;
          for(let i = 0; i < data.length; i++) {
              row = data[i];
              txt += row.id + ". " + row.title + "<br>";
          }

          document.getElementById("posts").innerHTML = txt;
          document.getElementById("page_no").innerHTML = page;
          paginate(page);
      }
  }

  request.send();
}

function paginate(page) {
  var request = new XMLHttpRequest();
  request.open("GET", "posts_api.php?action=nop");

  request.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          let data = JSON.parse(this.responseText);
          let pages = data.total;

          let txt = "";
          txt += "<a class='hyperlink' onclick='loadPosts(1)'> << </a>";
          txt += "<a class='hyperlink' onclick='loadPosts(" + (page-1) + ")'> < </a>";
          for (let i = 1; i <= pages; i++) {
              if (i == page) {
                  txt += " " + i + " ";
              }
              else {
                  txt += "<a class='hyperlink' onclick='loadPosts(" + i + ")'> " + i + " </a>";
              }
          }
          txt += "<a class='hyperlink' onclick='loadPosts(" + (page+1) + ")'> > </a>";
          txt += "<a class='hyperlink' onclick='loadPosts(" + pages + ")'> >> </a>";

          document.getElementById("pagination").innerHTML = txt;
      }
  }
  request.send();
}