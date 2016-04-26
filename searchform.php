<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="expandable-search-form">

<div id="expandable-search-box" class="searchbox-closed">
  <i id="expandable-search-button" class="fa fa-search" aria-hidden="true"></i>
  <input type="text" name="s" id="expandable-search-field" class="expandable-search-field"/>
  <input type="submit" id="searchsubmit"  value="Search" class="btn" />
</div>
</form>
<script>
var searchbox = document.getElementById("expandable-search-box");
var searchbutton = document.getElementById("expandable-search-button");
searchbutton.addEventListener('click', function () {
  if(searchbox.className === "searchbox-closed"){
    searchbox.className = "searchbox-open";
  } else {
    searchbox.className = "searchbox-closed";
  }
});
</script>
