<div style="background-color:#30DB97; height: 100%; width: 100%;" class="widget widget-graph convergence rickshaw_graph"><h1 class="title" style="text-align: center;">{title}</h1>

    <h2 class="value" style="text-align: center;">{value}</h2>

    <p class="more-info">{moreinfo}</p>
    <svg style="width: 100%; height: 100%;">
    
    {data}
    
    <g class="y_ticks plain"><g transform="translate(0,360)" style="opacity: 1;"><line class="tick" x2="4" y2="0"></line><text x="7" y="0" dy=".32em" text-anchor="start"></text></g>

    {yAxis}

    <path class="domain" d="M4,0H0V360H4"></path></g><g class="y_grid"><g transform="translate(0,360)" style="opacity: 1;"><line class="tick" x2="610" y2="0"></line><text x="613" y="0" dy=".32em" text-anchor="start"></text></g>

    <path class="domain" d="M610,0H0V360H610"></path></g></svg>

    {xAxis}

    <dl class="legend">
        {legend}
    </dl>


</div>