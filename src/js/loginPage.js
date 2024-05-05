$(document).ready(function () {
  $(".submit-btn").click((e) => {
    e.preventDefault();
    console.log("clicked");
    window.location.href = "../html/SchedulePage.html";
  });
});
