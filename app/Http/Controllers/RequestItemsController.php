<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TransactionDetail;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;

class RequestItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionItems = TransactionItem::orderBy('created_at', 'desc')
            ->get();

        return view('pages.request-items.index', [
            'transactionItems' => $transactionItems
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $items = Item::all();

        return view('pages.request-items.create', [
            'users' => $users,
            'items' => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loop = count($request->id);
        $user = User::where('nik', $request->nik)
            ->first();

        // simpan data peminta
        TransactionItem::create([
            'request_date' => $request->request_date,
            'user_id' => $user->id,
        ]);

        // ambil data transaksi item untuk didapatkan id-nya 
        $transactionItem = TransactionItem::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        for ($i=0; $i < $loop ; $i++) { 
            // simpan transaksi detail 
            TransactionDetail::create([
                'transaction_item_id' => $transactionItem->id,
                'item_id' => $request->id[$i],
                'quantity' => $request->quantity[$i],
                'description' => $request->description[$i]
            ]);

            // ambil data item untuk mendapatkan data available
            $item = Item::where('id', $request->id[$i])
                ->first();
            // available item - quantity request
            $available = $item->available - $request->quantity[$i];

            // update quantity item
            Item::where('id', $request->id[$i])
                ->update([
                    'available' => $available
                ]);
        }

        return redirect()->route('index')->with('pesan', 'Permintaan barang telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ambil data barang
        $transactionItem = TransactionItem::where('id', $id)
            ->first();

        // ambil data transaction details
        $transactionDetails = TransactionDetail::where('transaction_item_id', $id)
            ->get();
        
        return view('pages.request-items.show', [
            'transactionItem' => $transactionItem,
            'transactionDetails' => $transactionDetails,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ambil data transaction item
        // $transactionItem = TransactionItem::where('id', $id)
        //     ->first();

        // // ambil data transaction details
        // $transactionDetails = TransactionDetail::where('transaction_item_id', $id)
        //     ->get();

        // // total baris data transaction details 
        // $loop = count($transactionDetails);

        // dd($transactionDetails);

        // for ($i=0; $i < $loop ; $i++) { 
        //     echo $transactionDetails->item_id[$i];
        // }

        // // ambil data item 
        // $item = Item::where('id', $transactionItem->item_id)
        //     ->first();

        // lakukan penambahan stock

    }

    public function destroyTransactionDetail($id){
        // ambil data transaksi detail 
        $transactionDetail = TransactionDetail::where('id', $id)
            ->first();

        // ambil data transaksi item 
        $transactionItem = TransactionItem::where('id', $transactionDetail->transaction_item_id)
            ->first();

        // kembalikan quantity ke available 
        $item = Item::where('id', $transactionDetail->item_id)
            ->first();
        $quantity = $item->available + $transactionDetail->quantity;
        Item::where('id', $transactionDetail->item_id)
            ->update([
                'available' => $quantity
            ]);

        // hapus data transaksi detail
        TransactionDetail::where('id', $id)
            ->delete();

        // ambil total sisa data transaction detail 
        $sisaTransactionDetail = TransactionDetail::where('transaction_item_id', $transactionItem->id)
            ->get();
        $totalTransactionDetail = count($sisaTransactionDetail);

        // pengkondisian redirect 
        if ($totalTransactionDetail > 0) {
            // redirect ke data transaksi item 
            return redirect()->route('show', $transactionItem->id)->with('pesan', 'Detail transaksi telah dihapus');
        } else {
            // hapus data transaction item dan redirect ke index 
            TransactionItem::where('id', $transactionItem->id)
                ->delete();

            return redirect()->route('index')->with('pesan', 'Permintaan barang telah dihapus beserta semua detailnya');
        }
        
    }
}
