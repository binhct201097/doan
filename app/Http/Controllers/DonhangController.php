<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GiaohangRequest;
use App\Donhang;
use App\Lohang;
use App\Nhanvien;
use DB;
use PDF;

class DonhangController extends Controller
{
    public function getList()
    {
        DB::table('donhang')->where('donhang_payment', 'VnPay')
    ->where('donhang_paid', Null)->delete();
        $who_ship = DB::table('nhanvien')->get();
    	$data = DB::table('donhang')->orderBy('id','DESC')->get();
        // dd($data);
    	return view('admin.donhang.danhsach',compact('data','who_ship'));
    }

    public function getEdit($id)
    {
    	$whoship = DB::table('nhanvien')->get();
        foreach ($whoship as $key => $value) {
            $ws[] = ['id'=>$value->id, 'name'=>$value->nhanvien_ten];
        }
    	$data = DB::table('tinhtranghd')->get();
    	foreach ($data as $key => $value) {
    		$tinhtrang[] = ['id'=>$value->id, 'name'=>$value->tinhtranghd_ten];
    	}
    	$donhang = DB::table('donhang')->where('id',$id)->first();

        if($donhang->tinhtranghd_id == 3 OR $donhang->tinhtranghd_id == 4)
        {
            return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Đơn hàng đã được xử lý!!!']);
        } else {
            $khachhang = DB::table('khachhang')->where('id', $donhang->khachhang_id)->first();
            $chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
            return view('admin.donhang.sua',compact('ws','donhang','tinhtrang','khachhang','chitiet'));
        }
    	
    }

     public function postEdit(Request $request,$id)
    {
    	$whoship = DB::table('nhanvien')->get();
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$status1 = $donhang->tinhtranghd_id;
    	$status2 = $request->selStatus;
    	// $idSP = DB::table('chitietdonhang')->select('sanpham_id','chitietdonhang_so_luong')->where('donhang_id',$id)->get();
    	// // print_r($idSP);
    	// foreach ($idSP as $key => $val) {
    	// 	$idLHM = Db::table('lohang')->where('sanpham_id',$val->sanpham_id)->max('id');
    	// 	$lohang = DB::table('lohang')->where('id',$idLHM)->first();
    	// 	print_r($lohang);
    	// }

    	if ($status1 != $status2 && $status2 == 2) {
    		DB::table('donhang')->where('id',$id)
    			->update([
    					'tinhtranghd_id' => $status2,
    					'whoship' => $request->full_name
    				]);
    		$idSP = DB::table('chitietdonhang')
    			->select('sanpham_id','chitietdonhang_so_luong')
    			->where('donhang_id',$id)->get();
	    	foreach ($idSP as $key => $val) {
	    		$idLHM = Db::table('lohang')->where('sanpham_id',$val->sanpham_id)->max('id');
                // dd($idLHM);
	    		$lohang = DB::table('lohang')->where('id',$idLHM)->first();
	    		DB::table('lohang')
	    			->where('id',$idLHM)
	    			->update([
	    				'lohang_so_luong_da_ban' => $lohang->lohang_so_luong_da_ban + $val->chitietdonhang_so_luong,
	    				'lohang_so_luong_hien_tai' => $lohang->lohang_so_luong_hien_tai - $val->chitietdonhang_so_luong,
	    				]);
	    	}
    	}elseif ($status1 != $status2 && $status2 == 3) {
    		DB::table('donhang')->where('id',$id)
    			->update([
    					'tinhtranghd_id' => $status2,
    					'whoship' => $request->full_name
    				]);
    		$idSP = DB::table('chitietdonhang')
    			->select('sanpham_id','chitietdonhang_so_luong')
    			->where('donhang_id',$id)->get();
	    	foreach ($idSP as $key => $val) {
	    		$idLHM = Db::table('lohang')->where('sanpham_id',$val->sanpham_id)->max('id');
	    		$lohang = DB::table('lohang')->where('id',$idLHM)->first();
	    		DB::table('lohang')
	    			->where('id',$idLHM)
	    			->update([
	    				'lohang_so_luong_doi_tra' => $lohang->lohang_so_luong_doi_tra + $val->chitietdonhang_so_luong,
	    				'lohang_so_luong_hien_tai' => $lohang->lohang_so_luong_hien_tai + $val->chitietdonhang_so_luong,
	    				'lohang_so_luong_da_ban' => $lohang->lohang_so_luong_da_ban - $val->chitietdonhang_so_luong,
	    				]);
	    	}
    	}elseif ($status1 != $status2 && $status2 == 4) {
    		DB::table('donhang')->where('id',$id)
    			->update([
    					'tinhtranghd_id' => $status2,
    					'whoship' => $request->full_name
    				]);
    		$idSP = DB::table('chitietdonhang')
    			->select('sanpham_id','chitietdonhang_so_luong')
    			->where('donhang_id',$id)->get();
	    	foreach ($idSP as $key => $val) {
	    		$idLHM = Db::table('lohang')->where('sanpham_id',$val->sanpham_id)->max('id');
	    		$lohang = DB::table('lohang')->where('id',$idLHM)->first();
	    		DB::table('lohang')
	    			->where('id',$idLHM)
	    			->update([
	    				'lohang_so_luong_da_ban' => $lohang->lohang_so_luong_da_ban,
	    				'lohang_so_luong_hien_tai' => $lohang->lohang_so_luong_hien_tai,
	    				]);
	    	}
    	}
    	else {
    		DB::table('donhang')->where('id',$id)
    			->update([
    					'tinhtranghd_id' => $status2,
    					'whoship' => $request->full_name
    				]);
    	}
    	
    	return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
        	
    }

    //Cap nhat thong tin khach nhan hang
    public function getEdit1($id)
    {
        // $whoship = DB::table('nhanvien')->get();
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
    	$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
        if($donhang->tinhtranghd_id == 3 OR $donhang->tinhtranghd_id == 4 OR $donhang->tinhtranghd_id == 2)
        {
            return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Không thể sửa khi đơn hàng đang được giao hay xử lý!!!']);
        } else {
            return view('admin.donhang.suagiaohang',compact('donhang','tinhtrang','khachhang','chitiet'));
        }
    	
    }

    //Cap nhat thong tin thanh toan
    public function postEdit1(GiaohangRequest $request,$id)
    {
        // $whoship = DB::table('nhanvien')->get();

    	DB::table('donhang')
    		->where('id',$id)
    		->update([
    			'donhang_nguoi_nhan'=> $request->txtName,
    			'donhang_nguoi_nhan_sdt'=> $request->txtPhone,
    			'donhang_nguoi_nhan_email'=> $request->txtEmail,
    			'donhang_nguoi_nhan_dia_chi'=> $request->txtAddress,
    			'donhang_ghi_chu'=> $request->txtNote,
                // 'whoship' => $request->full_name
    		]);

    	return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    }

    public function getEdit2($id)
    {
    	$data = DB::table('tinhtranghd')->get();
		foreach ($data as $key => $val) {
			$tinhtrang[] = ['id' => $val->id, 'name'=> $val->tinhtranghd_ten];
		}
    	$donhang = DB::table('donhang')->where('id',$id)->first();
    	$khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
    	$chitiet = DB::table('chitietdonhang')->where('donhang_id',$donhang->id)->get();
        if($donhang->tinhtranghd_id == 3 OR $donhang->tinhtranghd_id == 4 OR $donhang->tinhtranghd_id == 2)
        {
            return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Không thể sửa khi đơn hàng đang được giao hay xử lý!!!']);
        } else {
            return view('admin.donhang.suathanhtoan',compact('donhang','tinhtrang','khachhang','chitiet'));
        }
    	
    }

    public function postEdit2(Request $request,$id)
    {
    	// $idSP = DB::table('chitietdonhang')->select('sanpham_id')->where('donhang_id',$id)->get();
    	$sp= DB::select('select sanpham_id,chitietdonhang_so_luong,chitietdonhang_thanh_tien,(chitietdonhang_thanh_tien/chitietdonhang_so_luong) as gia from chitietdonhang where donhang_id = ?', [$id]);
    	// dd($sp);
    	$data = $request->input('products',[]);
    	// dd($data);
    	for ($i=0; $i < count($sp); $i++) { 
    		$a = $sp[$i]->sanpham_id;
    		DB::table('chitietdonhang')
    			->where([['sanpham_id',$a],['donhang_id',$id] ])
    			->update([
    				'chitietdonhang_so_luong'=>$request->txtQuant[$i],
    				'chitietdonhang_thanh_tien'=>($request->txtQuant[$i]*$sp[$i]->gia),
    				]);
    	}

    	//Delete san pham khoi gio hang

    	foreach ($data as  $val) {
    		DB::table('chitietdonhang')
    			->where([['sanpham_id',$val],['donhang_id',$id] ])
    			->delete();
    	}

    	//Tinh lai tong gia tri don hang

    	$tong = DB::select('select sum(chitietdonhang_thanh_tien) as tong from chitietdonhang where donhang_id = ?', [$id]);
    	// print_r($tong[0]->tong);
    	$p = DB::table('donhang')
    		->where('id',$id)
    		->update([
    			'donhang_tong_tien' =>$tong[0]->tong,
    			]);

    	return redirect()->route('admin.donhang.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    }

    public function pdf($id)
    {
        $donhang = DB::table('donhang')->where('id',$id)->first();
        $chitietdonhang = DB::table('chitietdonhang')->where('donhang_id',$id)->get();
        $khachhang = DB::table('khachhang')->where('id',$donhang->khachhang_id)->first();
        // print_r($khachhang);
        $pdf = PDF::loadView('admin.donhang.hoadon',compact('donhang','chitietdonhang','khachhang'));
        return $pdf->download('hoadon'.$donhang->id.'.pdf');
    }
}
