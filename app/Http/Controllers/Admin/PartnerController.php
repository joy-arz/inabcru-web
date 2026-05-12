<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::orderBy('display_order')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create(): View
    {
        return view('admin.partners.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'logo_url' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'website_url' => 'nullable|string',
        ]);

        $data['display_order'] = Partner::max('display_order') + 1;
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner added');
    }

    public function edit(int $id): View
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.form', ['partner' => $partner, 'id' => $id]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $partner = Partner::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|string',
            'logo_url' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'website_url' => 'nullable|string',
        ]);

        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'partners' => 'required|array',
        ]);

        foreach ($data['partners'] as $item) {
            Partner::where('id', $item['id'])->update(['display_order' => $item['display_order']]);
        }

        return redirect()->back()->with('success', 'Order updated');
    }
}