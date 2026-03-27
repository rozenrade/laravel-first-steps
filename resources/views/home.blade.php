<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
    </head>
    <body>
        @auth
            <p>Congrats you got logged</p>
            <form action="/logout" method="post">
                @csrf
                <button>Log out</button>
            </form>

            <div style="border: 3px solid black">
                <h2>Hello {{ auth()->user()->name }} Create a post</h2>
                <form action="/create-post" method="post">
                    @csrf
                    <input name="title" type="text" placeholder="title" />
                    <textarea
                        name="content"
                        placeholder="content ..."
                    ></textarea>
                    <button>Create a post</button>
                </form>
            </div>

            <div style="border: 3px solid black">
                <h2>All Posts</h2>
                @foreach ($posts as $post)
                    <div
                        style="border: 1px solid black background-color: lightgray"
                    >
                        <h3>{{ $post->title }} by {{ $post->user->name }}</h3>
                        <p>{{ $post->content }}</p>
                        <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                        <form
                            action="/delete-post/{{ $post->id }}"
                            method="post"
                        >
                            @csrf
                            @method("DELETE")
                            <button>Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div style="border: 3px solid black">
                <h2>Register</h2>
                <form action="/register" method="POST">
                    @csrf
                    <input name="name" type="text" placeholder="name" />
                    <input name="email" type="text" placeholder="email" />
                    <input
                        name="password"
                        type="password"
                        placeholder="password"
                    />
                    <button>Register</button>
                </form>
            </div>

            <div style="border: 3px solid black">
                <h2>Login</h2>
                <form action="/login" method="POST">
                    @csrf
                    <input name="loginname" type="text" placeholder="name" />
                    <input
                        name="loginpassword"
                        type="password"
                        placeholder="password"
                    />
                    <button>Log in</button>
                </form>
            </div>
        @endauth
    </body>
</html>
