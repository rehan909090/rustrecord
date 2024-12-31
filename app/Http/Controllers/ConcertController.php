<?php
namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Artist; // Import model Artist
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    // Metode untuk menampilkan semua konser (index)
    public function index()
    {
        
        $concerts = Concert::all();
        return view('concerts.index', compact('concerts'));
    }

    // Metode untuk menampilkan detail konser berdasarkan ID
    public function show($id)
    {
        // Mencari konser berdasarkan ID dengan eager loading relasi 'artists'
        $concert = Concert::with('artists')->findOrFail($id);
        $ticket_price = $concert->ticket_price;
        // Mengembalikan view dengan data konser dan artis yang terhubung
        return view('concerts.show', compact('concert','ticket_price'));
    }

    // Metode untuk menambahkan konser (create)
    public function create()
    {
        $artists = Artist::all(); // Ambil data artis
        return view('concerts.create', compact('artists')); // Kirim data artis ke view
    }

    // Metode untuk menyimpan konser baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'ticket_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'artist_ids' => 'required|array', // Menambahkan validasi untuk artist_ids
        ]);
    
        $concert = new Concert();
        $concert->title = $request->title;
        $concert->description = $request->description;
        $concert->location = $request->location;
        $concert->date = $request->date;
        $concert->ticket_price = $request->ticket_price;
    
        if ($request->hasFile('image')) {
            $concert->image = $request->file('image')->store('concert_images', 'public');
        }
    
        $concert->save();
    
        // Menambahkan artis yang dipilih ke konser
        $concert->artists()->attach($request->artist_ids);
    
        // Redirect ke halaman concert index setelah berhasil
        return redirect()->route('concerts.index')->with('success', 'Konser berhasil disimpan!');
    }
    

    // Metode untuk mengedit konser
    public function edit($id)
    {
        $concert = Concert::findOrFail($id);
        $artists = Artist::all(); // Ambil semua artis untuk dropdown pilihan

        return view('concerts.edit', compact('concert', 'artists')); // Kirim data artis ke view
    }

    // Metode untuk mengupdate konser
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'ticket_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $concert = Concert::findOrFail($id);
        $concert->title = $request->title;
        $concert->description = $request->description;
        $concert->location = $request->location;
        $concert->date = $request->date;
        $concert->ticket_price = $request->ticket_price;

        if ($request->hasFile('image')) {
            $concert->image = $request->file('image')->store('concert_images', 'public');
        }

        // Update artis terkait dengan konser
        $concert->artists()->sync($request->artist_ids);

        $concert->save();

        return redirect()->route('concerts.index')->with('success', 'Konser berhasil diperbarui.');
    }

    // Metode untuk menghapus konser
    public function destroy($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();
        return redirect()->route('concerts.index')->with('success', 'Konser berhasil dihapus.');
    }
}
