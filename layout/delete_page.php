<!-- admin --> 
<style type="text/CSS"> 
.input-normal { 
	display: block; 
	padding: 5px; 
	border: 1px solid #dddddd; 
	background-color: #fbfbfb; 
	width: 200px; 
	border-radius: 4px; 
	margin: 5px; 
} 
.input-textarea { 
	display: block; 
	padding: 5px; 
	border: 1px solid #dddddd; 
	background-color: #fbfbfb; 
	width: 100%; 
	border-radius: 4px; 
	margin: 5px; 
} 
.cell { 
    display:  table-cell; 
    width:  50%; 
    float:  left;         
}
</style> 

<div class="article">
    <div class="headline">#[ID] [headline]</div>  
    <div class="content"> <br /> 
        <div class="cell">
            [date] 
        </div> 
        <div class="cell">
            [ <a href="action/page_delete.php?Label=[Label]">l&ouml;schen</a> ] [ <a href="?x=edit_page&Label=[Label]">editieren</a> ] 
        </div> 
        <div style="clear: both"></div>
    </div>
</div>