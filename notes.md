Notes
=====

* `admin-style.css:422` commenting out `display: none;` solved the issue of codemirror not showing initially. However there is now an issue before the js loads. The user will see other tab contents **before** the js loads and hides it.