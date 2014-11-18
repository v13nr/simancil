valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  


/*----window buyer ---- */
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
            params.attr = 'ext:qtip="Total no. of Product"'; // summary column tooltip example
            return v? ((v === 0 || v > 1) ? '(' + v +' Item)' : '(1 Item)') : '';
    }

    // custom summary renderer example
    function averageChange(v, params, data) {
            params.attr = 'ext:qtip="Average % Change"'; // summary column tooltip example
            return v? ('Average:&#160;' + v) : '';
    }

	
	var coaStore = new Ext.data.JsonStore({
		url:'modules/accounting/icon.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getCoa'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'kode'}, 
		  {name:'title'}
		],
		  sortInfo: {field: 'title', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	
	var summary = new Ext.ux.grid.GridSummary();
	
buyer_grid_order = Ext.extend(Ext.grid.EditorGridPanel, {
    title: 'Jurnal',
    region: 'center',
        plugins: [summary], // have the EditorGridPanel use the GridSummary plugin
        stripeRows: true,
    clicksToEdit:1,
    loadMask:true,
    removeData:[],
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
      {name:'coa', type:'string'},
      {name:'keterangan', type:'string'},
      {name:'debet', type:'int'},
      {name:'kredit', type:'int'}
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
	        },{
                xtype: 'gridcolumn',
                dataIndex: 'coa', summaryType: 'count', summaryRenderer: totalCompanies,
                header: 'COA',
                sortable: true,
                width: 250,
                editor: {
                    xtype: 'combo',
                    hideTrigger:false,
                    store:coaStore,
                  	displayField:'title',
                  	valueField:'title',
                  	pageSize:10,
                  	typeAhead:true,
                  	triggerAction:'all'
                }
            },
            {
                xtype: 'gridcolumn',
                dataIndex: 'keterangan', summaryType: 'count', summaryRenderer: totalCompanies,
                header: 'Keterangan',
                sortable: true,
                width: 250,
                editor: {
                    xtype: 'textfield'
                }
            },
            {
                xtype: 'numbercolumn',
                header: 'Debet', 
                sortable: true,
                width: 100,
                align: 'right',
                dataIndex: 'debet', renderer: 'usMoney', summaryType: 'sum',
				 summaryRenderer: function(value, summaryData, dataIndex) {
                	totalx = value;
					return 'Rp. '+ Ext.util.Format.number(value,"0,000") + ' ,-';
				},
				readonly:true,
                editor: new Ext.form.NumberField({allowDecimals: true})
            },
            {
                xtype: 'numbercolumn',
                header: 'Kredit', 
                sortable: true,
                width: 100,
                align: 'right',
                dataIndex: 'kredit', renderer: 'usMoney', summaryType: 'sum',
				 summaryRenderer: function(value, summaryData, dataIndex) {
                	anggaranx = value;
					return 'Rp. '+ Ext.util.Format.number(value,"0,000") + ' ,-';
				},
				readonly:true,
                editor: new Ext.form.NumberField({allowDecimals: true})
            }
        ];
        buyer_grid_order.superclass.initComponent.call(this);
    }, 
	callback: function(records, operation, success) {
        count = this.getCount();
        total = this.getTotalCount();
    },
    createTbar:function(){
      this.tbar = [
      {
        text:'Add Data',
        iconCls:'add-data', 
        scope:this,
        handler:function(){
          rec = new this.store.recordType({});
		  idx = this.store.getCount();
		  this.store.insert(idx,rec);
          this.getView().refresh();
          this.startEditing(idx,1);                
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
      }
      ]
    },
    getRemoveData:function(){
      return this.removeData; 
    }
});



buyer_form = Ext.extend(Ext.Window, {
    title: 'Buyer',
    width: 730,
    height: 459,
    layout: 'border',
    border: false,
    closeAction: 'hide',
    id: 'buyerWindow',
    modal:true,
    initComponent: function() {
        this.buttons = this.createButton(); 
        //this.grid = new buyer_grid_order({}); 
		this.grid = new buyer_grid_order({
      		listeners :{
      			afteredit:function(e){
      				if(e.field =='coa'){
      					if(e.value){
      						//console.log(e.value); 
							kode = n[1];
							//var kode = 'A::1110001::Kas Kecil';
      						var index = coaStore.find('title',e.value);
      						console.log(index);
      						if(index !=  -1){
      							var rec = coaStore.getAt(index);
								var teks=e.value.split("::");
								nama = teks[2]
      							e.record.set('keterangan',nama);
      							e.record.commit();
      						}else{
      							Ext.MessageBox.alert('Peringatan','No found item');
      							e.record.set('keterangan','?');
      							e.record.commit();
      						} 
      					}
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
                        xtype: 'textfield',
                        fieldLabel: 'No. Bukti',
                        anchor: '100%',
                        name: 'name',
                        allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Tanggal',
                        anchor: '100%',
                        name: 'address',
                        allowBlank: false
                    },
                    {
                        xtype: 'textarea',
                        anchor: '100%',
                        fieldLabel: 'Keterangan',
                        name: 'information'
                    }
                ]
            },this.grid
        ];
        buyer_form.superclass.initComponent.call(this);
    }, 
    createButton:function(){
      this.botBar = [
      {
        text:'Save',
        scope:this,
        handler:function(){
			if(totalx == anggaranx){
				this.saveData(); 
			} else {
				Ext.Msg.alert('Status', 'Tidak Balance');
			}
		  
          
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

win_buyer_form = new buyer_form({
   onSuccess:function(action){
    grid_buyer.store.reload(); 
    grid_order.store.reload(); 
   }
}); 



/*----end window---- */

var grid_buyer = new Ext.ux.PhpDynamicGridPanel({
    title:'Jurnal Header', 
    region:'center', 
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'name',direction:'ASC'}, //must declaration
    baseParams:{
      action:'getBuyer'
    }, 
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
    onAddData:function(bt){
      win_buyer_form.show(bt.id);    
      win_buyer_form.onAddData(); 
   },
    onEditData:function(bt,rec){
      win_buyer_form.setTitle('Edit Data');
      win_buyer_form.show(bt.id); 
      win_buyer_form.get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
      win_buyer_form.reloadGrid(rec.data.id); 
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

grid_buyer.getSelectionModel().on('rowselect',function(sel,index,rec){
  grid_order.store.baseParams.buyer_id = rec.data.id; 
  grid_order.store.reload(); 
}); 

var grid_order = new Ext.ux.DynamicGridPanel({
  title :'Jurnal', 
  border:false,
  region:'south', 
  height:270,
  collapsible:true,  
  remoteSort:true,
  storeUrl:ajax_url, 
  sortInfo:{field:'debet', direction:'DESC'}, 
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
  items : [grid_buyer,grid_order],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('buyerWindow');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 