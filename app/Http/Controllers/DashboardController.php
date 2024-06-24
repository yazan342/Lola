<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Category;
use App\Models\Color;
use App\Models\Flavor;
use App\Models\Order;
use App\Models\Shape;
use App\Models\Topping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $cakes = Cake::all();
        $users = User::all();
        $orders = Order::all();
        $flavors = Flavor::all();
        $shapes = Shape::all();
        $toppings = Topping::all();
        $colors = Color::all();
        $visitors = count(User::all());
        $categories = Category::all();
        return view('dashboard', compact('cakes', 'users', 'visitors', 'categories', 'orders', 'flavors', 'shapes', 'toppings', 'colors'));
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', ['user' => $user]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }

    public function storeCake(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'flavor' => 'required|string|max:255',
            'number_of_people' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        Cake::create([
            'name' => $request->name,
            'flavor' => $request->flavor,
            'number_of_people' => $request->number_of_people,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imageName
        ]);

        return redirect()->route('dashboard')->with('success', 'Cake created successfully.');
    }

    public function editCake(Cake $cake)
    {
        $categories = Category::all();
        return view('edit-cake', compact('cake', 'categories'));
    }

    public function update(Request $request, Cake $cake)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'flavor' => 'required|string|max:255',
            'number_of_people' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($cake->image);

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $cake->update(['image' => $imagePath]);
        }

        $cake->update($request->except('image'));

        return redirect()->route('dashboard')->with('success', 'Cake updated successfully.');
    }

    public function destroyCake(Cake $cake)
    {
        Storage::disk('public')->delete($cake->image);

        $cake->delete();
        return redirect()->route('dashboard')->with('success', 'Cake deleted successfully.');
    }


    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function indexOrder()
    {
        $orders = Order::all(); // Fetch all orders

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function showOrder(Order $order)
    {
        // Eager load related models if needed
        $order->load('orderCakes.cake', 'orderCustomCakes.customCake');

        return view('orders.show', compact('order'));
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyOrder(Order $order)
    {
        $order->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Order deleted successfully.');
    }


    public function storeFlavor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Handle file upload
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        // Create flavor
        $flavor = new Flavor();
        $flavor->name = $request->name;
        $flavor->image = $imageName;
        $flavor->price = $request->price;
        $flavor->save();

        return redirect()->route('dashboard')->with('success', 'Flavor created successfully.');
    }

    public function editFlavor(Flavor $flavor)
    {
        return view('flavor.edit', compact('flavor'));
    }

    public function updateFlavor(Request $request, Flavor $flavor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Update flavor
        $flavor->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($flavor->image);

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $flavor->image = $imageName;
        }

        $flavor->price = $request->price;
        $flavor->save();

        return redirect()->route('dashboard')->with('success', 'Flavor updated successfully.');
    }

    public function destroyFlavor(Flavor $flavor)
    {
        // Delete image from storage
        Storage::disk('public')->delete($flavor->image);

        // Delete flavor
        $flavor->delete();

        return redirect()->route('dashboard')->with('success', 'Flavor deleted successfully.');
    }



    public function storeShape(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Handle file upload
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        // Create flavor
        $flavor = new Shape();
        $flavor->name = $request->name;
        $flavor->image = $imageName;
        $flavor->price = $request->price;
        $flavor->save();

        return redirect()->route('dashboard')->with('success', 'Flavor created successfully.');
    }

    public function editShape(Shape $shape)
    {
        return view('shape.edit', compact('shape'));
    }

    public function updateShape(Request $request, Shape $shape)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Update flavor
        $shape->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete old image
            // Storage::disk('public')->delete($flavor->image);

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $shape->image = $imageName;
        }

        $shape->price = $request->price;
        $shape->save();

        return redirect()->route('dashboard')->with('success', 'Flavor updated successfully.');
    }

    public function destroyShape(Shape $flavor)
    {
        // Delete image from storage
        // Storage::disk('public')->delete($flavor->image);

        // Delete flavor
        $flavor->delete();

        return redirect()->route('dashboard')->with('success', 'Flavor deleted successfully.');
    }




    public function storeTopping(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Handle file upload
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        // Create flavor
        $topping = new Topping();
        $topping->name = $request->name;
        $topping->image = $imageName;
        $topping->price = $request->price;
        $topping->save();

        return redirect()->route('dashboard')->with('success', 'Topping created successfully.');
    }

    public function editTopping(Topping $topping)
    {
        return view('topping.edit', compact('topping'));
    }

    public function updateTopping(Request $request, Topping $topping)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
        ]);

        // Update flavor
        $topping->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete old image
            // Storage::disk('public')->delete($flavor->image);

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $topping->image = $imageName;
        }

        $topping->price = $request->price;
        $topping->save();

        return redirect()->route('dashboard')->with('success', 'Topping updated successfully.');
    }

    public function destroyTopping(Topping $topping)
    {
        // Delete image from storage
        // Storage::disk('public')->delete($flavor->image);

        // Delete flavor
        $topping->delete();

        return redirect()->route('dashboard')->with('success', 'Topping deleted successfully.');
    }



    public function storeColor(Request $request)
    {
        $request->validate([
            'hex' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);



        // Create flavor
        $color = new Color();
        $color->hex = $request->hex;
        $color->price = $request->price;
        $color->save();

        return redirect()->route('dashboard')->with('success', 'Color created successfully.');
    }

    public function editColor(Color $color)
    {
        return view('color.edit', compact('color'));
    }

    public function updateColor(Request $request, Color $color)
    {
        $request->validate([
            'hex' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Update flavor
        $color->hex = $request->hex;


        $color->price = $request->price;
        $color->save();

        return redirect()->route('dashboard')->with('success', 'Color updated successfully.');
    }

    public function destroyColor(Color $color)
    {
        // Delete image from storage
        // Storage::disk('public')->delete($flavor->image);

        // Delete flavor
        $color->delete();

        return redirect()->route('dashboard')->with('success', 'Color deleted successfully.');
    }
}
