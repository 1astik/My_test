jQuery(document).ready(function($) {
 $("#myTable").tablesorter({
  sortList:[[1,0]],
  sortForce:[[3,0]],
  widgets:['zebra'],
  cancelSelection:false
  debug:true
  headers:{
 1:{
 sorter:false
 }
  }
 });