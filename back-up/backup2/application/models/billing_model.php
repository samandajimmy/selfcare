<?php
/**
 * Billing model Class
 *
 */
class Billing_model extends CI_Model {
	/**
	 * Constructor
	 */
	function __construct(){
		parent::__construct();
		$this->baca = $this->load->database('altdb', TRUE);
    }
	
	/**
	 * Cek tabel user, apakah ada user dengan username dan password tertentu
	 */
	function get_bill_summary($custcode){		
		$this->baca->select("t1.ATRBTID AS HISTORYID");
		$this->baca->select("t0.ATRBAID AS CUSTOMERID");
		$this->baca->select("t0.ATRBAP03 AS CUSTOMERCODE");
		$this->baca->select("t3.ATRBTTYNM AS BILLINGTYPE");
		$this->baca->select("t1.ATRBTNOG AS INVOICENO");
		$this->baca->select("date_format(t1.ATRBTDT,'%d-%b-%Y') AS TRANSACTIONDATE",FALSE);
		$this->baca->select("date_format(t1.ATRBTDTD,'%d-%b-%Y') AS RECEIPTDATE", FALSE);
		$this->baca->select("format((sum(t2.ATRBTVAL) * if(find_in_set(2,t3.ATRBTTYFLAG),1,-(1))),0) AS AMOUNT", FALSE);
		$this->baca->select("concat('l1+u1') AS BALANCE");
				
		$this->baca->from("ta10_moratelv2_ap.ENTBA t0");
		$this->baca->join("ta10_moratelv2_ap.ENTBT t1", "t1.ATRBAIDP = t0.ATRBAID", "left");
		$this->baca->join("ta10_moratelv2_ap.ENTBT t2","t2.ATRBTIDP = t1.ATRBTID","left");
		$this->baca->join("ta10_moratelv2_ap.ENTBTTY t3","t3.ATRBTTYID = t1.ATRBTTYID","left");
		
		$this->baca->where("ifnull(t1.ATRBTIDP,0)",0);
		$wherein = 't3.ATRBTCID in (3,4,6)';
		$this->baca->where($wherein);
		$this->baca->where("t3.ATRBTTYNM", "Subscriber Invoice");
		$wheredate = "date_format(t1.ATRBTDT,'%Y-%m-%d') > (curdate() - interval 6 month)";
		$this->baca->where($wheredate);
		$this->baca->where("t0.ATRBAP03",  $custcode);
		
		$this->baca->group_by("t0.ATRBAID"); 
		$this->baca->group_by("t1.ATRBTID");
		return $this->baca->get();
	}
	
	function get_billing_h($bilhistid){
		$this->baca->select("t1.ATRBTID as HISTORYID");
		$this->baca->select("t0.ATRBAID as CUSTOMERID");
		$this->baca->select("t0.ATRBAP03 as CUSTOMERCODE");
		$this->baca->select("t3.ATRBTTYNM as BILLINGTYPE");
		$this->baca->select("t1.ATRBTNOG as INVOICENO");
		$this->baca->select("t0.ATRBACD AS CONTRACTNO");
		$this->baca->select("t0.ATRBAP10 AS INVno"); 
		$this->baca->select("date_format(t1.ATRBTDT,'%d-%b-%Y') as TRANSACTIONDATE",FALSE);
		$this->baca->select("date_format(t1.ATRBTDTD,'%d-%b-%Y') as RECEIPTDATE", FALSE);
		$this->baca->select("format((sum(t2.ATRBTVAL) * if(find_in_set(2,t3.ATRBTTYFLAG),1,-(1))),0) as AMOUNT", FALSE);
		$this->baca->select("round(sum(t2.ATRBTVAL) * if(find_in_set(2,t3.ATRBTTYFLAG), 1, -(1))) as ammount", FALSE);
		$this->baca->select("t4.CUSTOMERNAME");
		$this->baca->select("t4.BILLINGADDRESS");
		$this->baca->select("t4.PHONE");
		$this->baca->select("t4.MOBILE");
		//$this->baca->select("'' as  FAX");
		//$this->baca->select("'' as CUSTEMAIL");
		//$this->baca->select("'' as DEFAULTPWD");
		$this->baca->select("t4.email");
		$this->baca->select("t5.CUSTEMAIL");
		//$this->baca->select("'' as NPWP");
				
		$this->baca->from("ta10_moratelv2_ap.ENTBA as t0");
		$this->baca->join("ta10_moratelv2_ap.ENTBT as t1", "t1.ATRBAIDP = t0.ATRBAID", "left");
		$this->baca->join("ta10_moratelv2_ap.ENTBT as t2","t2.ATRBTIDP = t1.ATRBTID","left");
		$this->baca->join("ta10_moratelv2_ap.ENTBTTY as t3","t3.ATRBTTYID = t1.ATRBTTYID","left");
		$this->baca->join("t_ms_customer as t4","t4.CUSTOMERID = t0.ATRBAID","left");
		$this->baca->join("LOGIN_CUST as t5","t5.CUSTID = t0.ATRBAID","left");
		
		$this->baca->where("ifnull(t1.ATRBTIDP,0)",0);
		$wherein = 't3.ATRBTCID in (3,4,6)';
		$this->baca->where($wherein);
		$this->baca->where("t3.ATRBTTYNM", "Subscriber Invoice");
		$wheredate = "date_format(t1.ATRBTDT,'%Y-%m-%d') > (curdate() - interval 6 month)";
		$this->baca->where($wheredate);
		$this->baca->where("t1.ATRBTID",  $bilhistid);
		
		$this->baca->group_by("t0.ATRBAID"); 
		$this->baca->group_by("t1.ATRBTID");
		return $this->baca->get();
	}
	
	
	function get_adm($custcode,$bln,$thn){	
	 	$this->baca->select("t0.ATRBAID");
		$this->baca->select("t4.ATRBENM as CustName");
		$this->baca->select("t0.ATRBAP03 as CustCode");
		$this->baca->select("t7.ATRLVNM as CustStat");
		$this->baca->select("t8.*");
		$this->baca->from("ta10_moratelv2_ap.ENTBA t0");
		$this->baca->join("ta10_moratelv2_ap.ENTBAP t1","t1.ATRBAPID = t0.ATRBAPID","LEFT");
		//$this->baca->join("ta10_moratelv2_ap.ENTBA t2","t2.ATRBAID = t0.ATRBAIDP","LEFT"); 
		$this->baca->join("ta10_moratelv2_ap.ENTBE t4","t4.ATRBEID = t0.ATRBEID","LEFT"); 
		$this->baca->join("ta10_moratelv2_ap.ENTBAC t6","t6.ATRBACID = t0.ATRBACID","LEFT");
		$this->baca->join("ta10_moratelv2_ap.ENTLV t7","t7.ATRLVCD=t0.ATRBAST","LEFT");
		$this->baca->join("self_care.t_tmp_billing_det t8","t0.ATRBAID = t8.ATRBAIDP","INNER");
		$this->baca->where("t6.ATRBACNM","Customer");
		$this->baca->where("t7.ATRLVTYID",8); 
		$this->baca->where("t0.ATRBAP03",$custcode);
		$this->baca->where("MONTH(t8.ATRBTDT)",$bln);
		$this->baca->where("YEAR(t8.ATRBTDT)",$thn);		
		$pname = array('PPN','Biaya Administrasi');
		$this->baca->where_in('t8.PRODUCTNAME',$pname);
		$this->baca->order_by("t8.PRODUCTNAME","ASC");
		return $this->baca->get();
	}	

	
	function get_billing_d($historyid){
		$this->baca->select("t0.ATRBTID AS ATRBTID");
		$this->baca->select("t3.ATRBTNOG AS INVOICENO");
		$this->baca->select("t0.ATRBAIDP AS ATRBAIDP");
		$this->baca->select("t0.ATRBTIDP AS ATRBTIDP");
		$this->baca->select("date_format(t3.ATRBTDTD,'%d-%b-%Y') AS DUEDATE",FALSE);
		$this->baca->select("date_format(t3.ATRBTDT,'%d-%b-%Y') AS INVOICE_PERIODE",FALSE);
		$this->baca->select("t1.ATRBIID AS TRBCD");
		$qrys1 ="if((t3.ATRBTDTP > '2012-06-25'),concat(substring_index(substr(t0.ATRBTDSC,9,200),'(',1),if((length(substring_index(substr(t0.ATRBTDSC,9,200),'(',1)) > 1),concat(' '),''),t1.ATRBINM),t1.ATRBINM) AS DESCRIPTION";
		$this->baca->select($qrys1,FALSE);
		$this->baca->select("format(t0.ATRBTQTY,2) AS QUANTITY",FALSE);
		$this->baca->select("cast(t0.ATRBTVALU as unsigned) AS PRICE",false);
		$this->baca->select("t0.ATRBTVAL AS TOTAL_PRICE");
		$qrys1 ="concat(date_format(if(t0.ATRBTVSA,t0.ATRBTVSA,t3.ATRBTDT),'%d %b %y'),' - ',date_format(if(t0.ATRBTVSO,t0.ATRBTVSO,((t3.ATRBTDT + interval 1 month) - interval 1 day)),'%d %b %y')) AS PERIODE";
		$this->baca->select($qrys1,FALSE);
		$this->baca->from("ta10_moratelv2_ap.ENTBT t0");
		$this->baca->join("ta10_moratelv2_ap.ENTBI t1","t1.ATRBIID = t0.ATRBIID","LEFT"); 
		$this->baca->join("ta10_moratelv2_ap.ENTUNIT t2","t2.ATRUNITID = t0.ATRUNITID","LEFT");
		$this->baca->join("ta10_moratelv2_ap.ENTBT t3","t3.ATRBTID = t0.ATRBTIDP","LEFT"); 
		$names = array(1,2,3,4,10);
		$this->baca->where_in('t0.ATRTRFTYID', $names);
		$this->baca->where("t0.ATRBIID !=",643); 
		$this->baca->where("t0.ATRBTIDP",$historyid);
		//$this->baca->order_by("t1.ATRBICID","DESC");
		return $this->baca->get();
	}
	
	function get_billing_footer($invoiceno){
		$this->baca->select('t0.ATRBAID AS ATRBAID');
		$this->baca->select('t0.ATRBAP03 AS CUSTOMERCODE');
		$this->baca->select('t0.ATRBACD AS CONTRACTNO');
		$this->baca->select('t4.ATRBEBANKNO AS VAMANDIRI');
		$this->baca->select('t5.ATRBEBANKNO AS VABCA');
		$this->baca->select('t1.baid AS baid');
		$this->baca->select('t1.ivno AS INVOICENO');
		$this->baca->select('t2.lastivno AS LASTINVOICENO');
		$this->baca->select('cast(t1.ivval as unsigned) AS SUMTOTALINVOICE');
		$this->baca->select('t1.pivno AS PREVIOUSNO');
		$this->baca->select('t1.pivdt AS PREVIOUSINVOICEDATE');
		$this->baca->select('t2.prevbal AS PREVIOUSBALANCE');
		$this->baca->select('t2.lastpay AS LASTPAYMENT');
		$this->baca->select('t2.lastpaydt AS LASTPAYDATE');
		$this->baca->from('ta10_moratelv2_ap.ENTBA t0');
		$this->baca->join('ta10_moratelv2_ap.billiv t1','t0.ATRBAID = t1.baid','LEFT');
		$this->baca->join('ta10_moratelv2_ap.billdata t2','t1.baid = t2.baid and t1.pivno = t2.lastivno','LEFT'); 
		$this->baca->join('ta10_moratelv2_ap.ENTBEBANK t4','t4.ATRBEID = t0.ATRBEID','LEFT');
		$this->baca->join('ta10_moratelv2_ap.ENTBEBANK t5','t5.ATRBEID = t0.ATRBEID','LEFT');
		$this->baca->where('t5.ATRBEBANKTY',601);
		$this->baca->where('t4.ATRBEBANKTY', 602);
		$this->baca->where ('t1.ivno',$invoiceno);
		
		return $this->baca->get();
	}
	

}
// END Billing model Class

/* End of file Billing model.php */ 
/* Location: ./system/application/model/Billing model.php */