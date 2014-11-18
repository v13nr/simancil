valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

var winprint_01 = new Ext.Panel({
  height: 800, 
  width: 1280, 
  title: 'DATA MONITORING', 
  html: '<iframe src="printing/monitoring.php?id=1" height=100% width=100%></iframe>',
  id: 'laporan',
  autoScroll:true,
    tbar    : [
      '-', // Fill
      {
        text    : 'Cetak',
		iconCls:'report-mode',
        handler:function(){
        //options = dynamic_grid_people.getParamsFilter();
        report_link = 'printing/monitoring.php?id=1';
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'DATA MONITORING',
            url : report_link,
            type : this.mode,
            params:options        
        }); 
      }
      }
    ]
});

var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,
  autoScroll:true,  
  layout:'border', //split for 2 column layout
  items : [winprint_01]
}; 