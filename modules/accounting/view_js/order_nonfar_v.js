valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

var idxnonfar = 0
/*----window buyer ---- */
// nanang
	var dsRekananOrder = new Ext.data.JsonStore({
		url:'icon.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getRekanan'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'rekanan_nama'}
		],
		  sortInfo: {field: 'rekanan_nama', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	var dsInstalasi = new Ext.data.JsonStore({
		url:'icon.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getInstalasi'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'nama_instalasi'}
		],
		  sortInfo: {field: 'nama_instalasi', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	var dsAkun = new Ext.data.JsonStore({
		url:'icon.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getAkun'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'title'}, 
		  {name:'sort_id'}
		],
		  sortInfo: {field: 'sort_id', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	var dsJenis = new Ext.data.JsonStore({
		url:'icon.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getJenis'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'jenis'}
		],
		  sortInfo: {field: 'jenis', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	
	Ext.util.Format.usMoney = function(v) { // override Ext.util.usMoney
    v = Ext.num(v, 0); // ensure v is a valid numeric value, otherwise use 0 as a base (fixes $NaN.00 appearing in summaryRow when no records exist)
    v = (Math.round((v - 0) * 100)) / 100;
    v = (v == Math.floor(v)) ? v + ".00" : ((v * 10 == Math.floor(v * 10)) ? v + "0" : v);
    v = String(v);

    var ps = v.split('.');
    var whole = ps[0];
    var sub = ps[1] ? '.'+ ps[1] : '.00';
    var r = /(\d+)(\d{3})/;

    while (r.test(whole)) {
				whole = whole.replace(r, '$1' + ',' + '$2');
		}

		v = whole + sub;

		if (v.charAt(0) == '-') {
			return '-$' + v.substr(1);
		}

		return "$" + v;
	}

	    // custom renderer example
    function change(val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '</span>';
        } else if (val < 0) {
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    }

    // custom renderer example
    function pctChange(val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '%</span>';
        } else if(val < 0) {
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }

    // custom summary renderer example
    function totalCompanies(v, params, data) {
            params.attr = 'ext:qtip="Total no. of companies"'; // summary column tooltip example
            return v? ((v === 0 || v > 1) ? '(' + v +' Companies)' : '(1 Company)') : '';
    }

    // custom summary renderer example
    function averageChange(v, params, data) {
            params.attr = 'ext:qtip="Average % Change"'; // summary column tooltip example
            return v? ('Average:&#160;' + v) : '';
    }
	
var summary = new Ext.ux.grid.GridSummary();
	
nonfar_grid_order = Ext.extend(Ext.grid.EditorGridPanel, {
    title: 'Order',
    region: 'center',
    clicksToEdit:1,
    loadMask:true,
    removeData:[],
	
	//nng
        plugins: [summary], // have the EditorGridPanel use the GridSummary plugin
        stripeRows: true,
		
		
    store: new Ext.data.JsonStore({
      url:ajax_url, 
      root:'data', 
      successProperty:'success',
      totalProperty:'total',
      autoLoad: false,
      remoteSort:false, 
      baseParams:{
        action :'getOrder', 
        buyer_id:0
      }, 
      fields:[
      {name:'id', type:'int'},
      {name:'name', type:'string'},
      {name:'price', type:'float'},
      {name:'count', type:'int'},
	  {name:'nosp', type:'string'},
      {name:'tanggalsp', type:'date', format: 'd/m/Y'},
	  {name:'nofaktur', type:'string'}
      ]
    }),	
    initComponent: function() {
        this.createTbar(); 
        this.columns = [
	        {
	          xtype:'numbercolumn', 
              hidden:true,
              dataIndex:'id', 
              hideable:false
	        },
           {
                //xtype: 'numbercolumn',
                header: 'Keterangan',
                format:'0',
                sortable: true,
                width: 500,
				height: 300,
                align: 'left',
                dataIndex: 'keterangan',
                editor: {
                    xtype: 'textarea'
                }
            },
			{
                xtype: 'numbercolumn',
                dataIndex: 'price',
				editor: new Ext.form.NumberField({allowDecimals: true}),
                header: 'Harga',
                sortable: true,
                width: 120,
                align: 'right',
                editor: new Ext.form.NumberField({allowDecimals: true})
            },
			{
                xtype: 'numbercolumn',
                dataIndex: 'count',
				summaryType: 'sum', editor: new Ext.form.NumberField({allowDecimals: true}),
                header: 'Qty',
                sortable: true,
                width: 120,
                align: 'right',
                editor: new Ext.form.NumberField({allowDecimals: true})
            },
            {
                xtype: 'numbercolumn',
                dataIndex: 'jumlah',
				summaryType: 'sum', editor: new Ext.form.NumberField({allowDecimals: true}),
                header: 'Realisasi',
                sortable: true,
                width: 120,
                align: 'right',
				readonly:true,
                editor: new Ext.form.NumberField({allowDecimals: true})
            }
            
        ];
        nonfar_grid_order.superclass.initComponent.call(this);
    }, 
    createTbar:function(){
      this.tbar = [
      {
        text:'Add Data',
        iconCls:'add-data', 
        scope:this,
        handler:function(){
          rec = new this.store.recordType({});
          this.store.insert(0,rec);
          this.getView().refresh();
          this.startEditing(0,1);                
        }
      },{
        text:'Remove Data',
        iconCls:'table-delete',
        scope:this,
        handler:function(){
          this.stopEditing();
          rec = this.getSelectionModel().getSelectedCell(); 
          if (!rec){
             Ext.example.msg('Peringatan','Seleksi data terlebih dahulu');
             return false;
          }
          record_data = this.store.getAt(rec[0]); 
          if (record_data.data.id){
            this.removeData.push(record_data.data.id);             
          }
	      this.store.remove(this.store.getAt(rec[0]));
	      this.getView().refresh();
	      if (this.store.getCount() > 0){
	        if (rec[0] > 0)
	          this.getSelectionModel().select(rec[0] - 1, rec[1]);
	        else
	          this.getSelectionModel().select(rec[0], rec[1]);
	      }          
        }
      },{
        text:'Summary Data',
        iconCls:'table-add',
        scope:this,
        text: 'Toggle Summary',
        handler: function(btn, e) {
            summary.toggleSummary();
        }
      }
      ]
    },
    getRemoveData:function(){
      return this.removeData; 
    }
});



nonfar_form = Ext.extend(Ext.Window, {
    title: 'Buyer',
    width: 950,
    height: 459,
    layout: 'border',
    border: false,
    closeAction: 'hide',
    id: 'nonfarWindow',
    modal:true,
    initComponent: function() {
        this.buttons = this.createButton(); 
        this.grid = new nonfar_grid_order({
      		listeners :{
				beforeedit: function(e){
						if (e.field =='jumlah')
							e.cancel =true; 		
						},
      			afteredit:function(e){
      				if(e.field =='name'){
      					if(e.value){
      						//console.log(e.value);
      						var index = dsRekananOrder.find('rekanan_nama',e.value);
      						//console.log(index);buat  belajar di comment aja gan
      						if(index !=  -1){
      							var rec = dsRekananOrder.getAt(index);
      							e.record.set('rekanan_id',rec.data.id);
      							e.record.commit();
      						}else{
      							Ext.MessageBox.alert('Peringatan','No found item');
      							e.record.set('name',null);
      							e.record.commit();
      						}
      					}
      				}
					if(e.field =='count'){
						harga = e.record.get('price') * e.record.get('count');
						e.record.set('jumlah',harga);
						e.record.commit();
      				}
					if(e.field =='price'){
						harga = e.record.get('price') * e.record.get('count');
						e.record.set('jumlah',harga);
						e.record.commit();
      				}
      			}
      		}
        }); 
        this.items = [
            {
                xtype: 'form',
                region: 'north',
                border: false,
                frame: true,
                url:ajax_url, 
                autoHeight: true,
                layoutConfig: {
                    labelSeparator: ' '
                },
                items: [
                    {
                        xtype: 'hidden',
                        fieldLabel: 'Label',
                        anchor: '100%',
                        name: 'id'
                    },
                    {
                        xtype: 'combo',
						hideTrigger:false,
                        fieldLabel: 'COA',
                        anchor: '100%',
						store:dsAkun,
						displayField:'title',
						valueField:'id',
						hiddenName: 'rekanan_id',
						pageSize:10,
						typeAhead:true,
						triggerAction:'all',
                        allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Tanggal',
                        anchor: '100%',
                        name: 'tanggal',
						format:'d/m/Y',
                        allowBlank: false
                    },
					{
                        xtype: 'combo',
						hideTrigger:false,
                        fieldLabel: 'Instalasi',
                        anchor: '100%',
						store:dsInstalasi,
						displayField:'nama_instalasi',
						valueField:'id',
						hiddenName: 'address',
						pageSize:10,
						typeAhead:true,
						triggerAction:'all',
                        allowBlank: false
                    },
                    {
                        xtype: 'textarea',
                        anchor: '100%',
                        fieldLabel: 'Information',
                        name: 'information'
                    },
					{
                        xtype: 'combo',
						hideTrigger:false,
                        fieldLabel: 'Jenis',
                        anchor: '100%',
						store:dsJenis,
						displayField:'jenis',
						valueField:'id',
						hiddenName: 'jenis',
						//pageSize:10,
						typeAhead:true,
						triggerAction:'all',
                        allowBlank: false
                    }
                ]
            },this.grid
        ];
        nonfar_form.superclass.initComponent.call(this);
    }, 
    createButton:function(){
      this.botBar = [
      {
        text:'Save',
        scope:this,
        handler:function(){
          this.saveData(); 
        }
      },{
        text:'Close',
        scope:this,
        handler:function(){
          this.hide(); 
        }
      }
      ]; 
      return this.botBar; 
    },
    saveData:function(){
      form = this.get(0).form; 
      if (!form.isValid()){
        Ext.example.msg('Peringatan','Ada data yang tidak valid!'); 
        return false;
      }
      data =[]; 
      this.grid.store.each(function(r,i){
        data.push(r.data); 
      });
      id_data = form.getValues().id; 
      action = (id_data)?'update':'create'; 
      form.submit({
        scope:this,
        params:{
          action:action, 
          detail:Ext.encode(data),
          remove:this.grid.getRemoveData().join(',')
        }, 
        waitMsg:'Saving Data', 
        success:function(){
          this.hide(); 
          this.onSuccess(action); 
        },
        failure:function(form,action){          
	         switch (action.failureType) {
	            case Ext.form.Action.CLIENT_INVALID:
	                Ext.MessageBox.alert('Failure', 'Form fields may not be submitted with invalid values');
	                break;
	            case Ext.form.Action.CONNECT_FAILURE:
	                Ext.MessageBox.alert('Failure', 'Ajax communication failed');
	                break;
	            case Ext.form.Action.SERVER_INVALID:
	                Ext.MessageBox.alert('Failure', action.result.message);
	                break;
	        }  
          
        }
      });
    }, 
    onSuccess:function(action){
      
    },
    onAddData:function(){
      this.get(0).form.reset(); 
      this.grid.store.baseParams.buyer_id = 0; 
      this.grid.store.reload(); 
    },
    reloadGrid:function(buyer_id){
      this.grid.store.baseParams.buyer_id = buyer_id;
      this.grid.store.reload(); 
    }
    
});

win_nonfar_form = new nonfar_form({
   onSuccess:function(action){
    grid_nonfar.store.reload(); 
    grid_order.store.reload(); 
   }
}); 



/*----end window---- */

var grid_nonfar = new Ext.ux.PhpDynamicGridPanel({
    title:'Kendali Non Farmasi', 
    region:'center', 
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'id',direction:'DESC'}, //must declaration
    baseParams:{
      action:'getBuyer'
    },
	tbar:[
    '-',{
      text:'Print',
      iconCls:'report-mode',
      mode:'html',
      handler:function(){
		//idx = rec.data.id;
		if (idxnonfar==0){
             Ext.example.msg('Peringatan','Seleksi data terlebih dahulu');
             return false;
          }
        options = grid_nonfar.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
		var winprint_02 = new Ext.Window ({
            height: 500, 
			  width: 800, 
			  maximizable: true,
            title : 'Kendali Bahan Farmasi',
			html: '<iframe src="printing/kendali_nonfar_print_pre.php?id='+ idxnonfar +'" height=100% width=100%></iframe>',
            closeAction: 'close',
			  id: 'printWindow_ordernonfar'       
        }); 
		winprint_02.show();
      }
    }
    ],
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
    onAddData:function(bt){
      win_nonfar_form.show(bt.id);    
      win_nonfar_form.onAddData(); 
   },
    onEditData:function(bt,rec){
      win_nonfar_form.setTitle('Edit Data');
      win_nonfar_form.show(bt.id); 
      win_nonfar_form.get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
      win_nonfar_form.reloadGrid(rec.data.id); 
    },   
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: ajax_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(res){
          result = Ext.decode(res.responseText); 
          if (result.success){
	          this.store.reload(); 
	          grid_order.store.reload();            
          }else{
            Ext.MessageBox.alert('Error',result.message);
          }

        },
        scope:this
      });       
    }    
}); 

grid_nonfar.getSelectionModel().on('rowselect',function(sel,index,rec){
  grid_order.store.baseParams.buyer_id = rec.data.id; 
  idxnonfar = rec.data.id //nanang
  grid_order.store.reload(); 
}); 

var grid_order = new Ext.ux.DynamicGridPanel({
  title :'Rekanan', 
  border:false,
  region:'south', 
  height:270,
  collapsible:true,  
  remoteSort:true,
  storeUrl:ajax_url, 
  sortInfo:{field:'name', direction:'ASC'}, 
  baseParams:{
    action:'getOrder', 
    buyer_id:0
  }
}); 



var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  layout:'border', //split for 2 column layout
  items : [grid_nonfar,grid_order],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('nonfarWindow');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 