<div style="">
<h1 class="title">{title}</h1>

<ol>
  <li data-foreach-item="items">
    <span class="label" >{olabel}</span>
    <span class="value" >{olvalue}</span>
  </li>
  <li data-foreach-item="items">
    <span class="label">{olabel2}</span>
    <span class="value" >{olvalue2}</span>
  </li>
</ol>

<!--<ul class="list-nostyle">
  <li data-foreach-item="items">
    <span class="label" data-bind="item.label">{ulable}</span>
    <span class="value" data-bind="item.value">{ulvalue}</span>
  </li>
</ul>-->

<p>more info here</p>
<p>{footer}</p>
</div>