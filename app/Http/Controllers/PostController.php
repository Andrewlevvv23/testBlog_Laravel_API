<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Перевірка на тип та розмір файлу (pdf, doc и docx)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $post = new Post([                                       // Добавленя даних в БД через конструктор класу Post, для динамічного присвоєння атрибутів при збереженні
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
        ]);

        if ($request->hasFile('file')) {                      // логіка збереження файлів в папку 'uploads'
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $post->file = $fileName;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $post->image = 'storage/images/' . $imageName;
        }

        $post->save();                                            //збереження  всіх атрибутів у БД

        return redirect()->route('posts.index')->with('success', 'Пост успішно створений.');

    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
       //валідую отримані дані з форми
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',  //не нуль, тип файл, розширення(пдф, док, докс)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($post->id);      //витягую даний пост з БД по його ID і зберію дану модель у змінну $post

        $post->title = $validatedData['title'];   //обновляю заголовок поста, присвоюючи дані з актуальної форми
        $post->body = $validatedData['body'];     //обновляю тіло поста (сам тект)

        // Якщо вибраний чекбокс видалення поточного файлу->
        if ($request->has('delete_file')) {
            // - Видаляю поточний файл
            $this->deleteFile($post->file);
            $post->file = null;
        }

        // Якщо завантажений новий файл
        if ($request->hasFile('file')) {
            // Видаляю поточний файл (если він існує)
            if ($post->file) {
                $this->deleteFile($post->file);
            }
            // Завантажую новий файл і зберігаю його імʼя
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $post->file = $fileName;
        }
        // Якщо вибраний чекбокс видалення поточної картинки->
        if ($request->has('delete_image')) {
            // Видаляю поточне зображення
            if ($post->image && Storage::exists('public/images/' . basename($post->image))) {
                Storage::delete('public/images/' . basename($post->image));
                $post->image = null;
            }
        }

        if ($request->hasFile('image')) {
            // Видаляєм поточне зображення (якщо воно існує)
            if ($post->image && Storage::exists('public/images/' . basename($post->image))) {
                Storage::delete('public/images/' . basename($post->image));
            }

            // Завантажую нове зображення і зберігаю шлях до нього
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $post->image = 'storage/images/' . $imageName;
        }

        $post->save();   //зберігаю всі зміни в змінні $post

        return redirect()->route('posts.index');

    }

    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        //dd($post);
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Пост не знайдено!');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост видалено успішно!');
    }

    //Додаткові методи для фільтрації постів:
    public function indexByTitle()
    {
        $posts = Post::orderBy('title', 'asc')->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function indexByDate()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    private function deleteFile($fileName)
    {
        if (file_exists(public_path('uploads/' . $fileName))) {
            unlink(public_path('uploads/' . $fileName));
        }
    }
}

