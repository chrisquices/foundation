<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ComponentController extends Controller
{
    public function index()
    {
        return to_route('backend.components.accordion');
    }

    public function accordion()
    {
        return Inertia::render('backend/components/Accordion');
    }

    public function alert()
    {
        return Inertia::render('backend/components/Alert');
    }

    public function alertDialog()
    {
        return Inertia::render('backend/components/AlertDialog');
    }

    public function aspectRatio()
    {
        return Inertia::render('backend/components/AspectRatio');
    }

    public function avatar()
    {
        return Inertia::render('backend/components/Avatar');
    }

    public function badge()
    {
        return Inertia::render('backend/components/Badge');
    }

    public function breadcrumb()
    {
        return Inertia::render('backend/components/Breadcrumb');
    }

    public function button()
    {
        return Inertia::render('backend/components/Button');
    }

    public function buttonGroup()
    {
        return Inertia::render('backend/components/ButtonGroup');
    }

    public function calendar()
    {
        return Inertia::render('backend/components/Calendar');
    }

    public function card()
    {
        return Inertia::render('backend/components/Card');
    }

    public function carousel()
    {
        return Inertia::render('backend/components/Carousel');
    }

    public function chart()
    {
        return Inertia::render('backend/components/Chart');
    }

    public function checkbox()
    {
        return Inertia::render('backend/components/Checkbox');
    }

    public function collapsible()
    {
        return Inertia::render('backend/components/Collapsible');
    }

    public function combobox()
    {
        return Inertia::render('backend/components/Combobox');
    }

    public function command()
    {
        return Inertia::render('backend/components/Command');
    }

    public function contextMenu()
    {
        return Inertia::render('backend/components/ContextMenu');
    }

    public function dataTable()
    {
        return Inertia::render('backend/components/DataTable');
    }

    public function datePicker()
    {
        return Inertia::render('backend/components/DatePicker');
    }

    public function dialog()
    {
        return Inertia::render('backend/components/Dialog');
    }

    public function drawer()
    {
        return Inertia::render('backend/components/Drawer');
    }

    public function dropdownMenu()
    {
        return Inertia::render('backend/components/DropdownMenu');
    }

    public function empty()
    {
        return Inertia::render('backend/components/Empty');
    }

    public function field()
    {
        return Inertia::render('backend/components/Field');
    }

    public function reactHookForm()
    {
        return Inertia::render('backend/components/ReactHookForm');
    }

    public function hoverCard()
    {
        return Inertia::render('backend/components/HoverCard');
    }

    public function input()
    {
        return Inertia::render('backend/components/Input');
    }

    public function inputGroup()
    {
        return Inertia::render('backend/components/InputGroup');
    }

    public function inputOtp()
    {
        return Inertia::render('backend/components/InputOtp');
    }

    public function item()
    {
        return Inertia::render('backend/components/Item');
    }

    public function kbd()
    {
        return Inertia::render('backend/components/Kbd');
    }

    public function label()
    {
        return Inertia::render('backend/components/Label');
    }

    public function menubar()
    {
        return Inertia::render('backend/components/Menubar');
    }

    public function navigationMenu()
    {
        return Inertia::render('backend/components/NavigationMenu');
    }

    public function pagination()
    {
        return Inertia::render('backend/components/Pagination');
    }

    public function popover()
    {
        return Inertia::render('backend/components/Popover');
    }

    public function progress()
    {
        return Inertia::render('backend/components/Progress');
    }

    public function radioGroup()
    {
        return Inertia::render('backend/components/RadioGroup');
    }

    public function resizable()
    {
        return Inertia::render('backend/components/Resizable');
    }

    public function scrollArea()
    {
        return Inertia::render('backend/components/ScrollArea');
    }

    public function select()
    {
        return Inertia::render('backend/components/Select');
    }

    public function separator()
    {
        return Inertia::render('backend/components/Separator');
    }

    public function sheet()
    {
        return Inertia::render('backend/components/Sheet');
    }

    public function sidebar()
    {
        return Inertia::render('backend/components/Sidebar');
    }

    public function skeleton()
    {
        return Inertia::render('backend/components/Skeleton');
    }

    public function slider()
    {
        return Inertia::render('backend/components/Slider');
    }

    public function sonner()
    {
        return Inertia::render('backend/components/Sonner');
    }

    public function spinner()
    {
        return Inertia::render('backend/components/Spinner');
    }

    public function switch()
    {
        return Inertia::render('backend/components/Switch');
    }

    public function table()
    {
        return Inertia::render('backend/components/Table');
    }

    public function tabs()
    {
        return Inertia::render('backend/components/Tabs');
    }

    public function textarea()
    {
        return Inertia::render('backend/components/Textarea');
    }

    public function toast()
    {
        return Inertia::render('backend/components/Toast');
    }

    public function toggle()
    {
        return Inertia::render('backend/components/Toggle');
    }

    public function toggleGroup()
    {
        return Inertia::render('backend/components/ToggleGroup');
    }

    public function tooltip()
    {
        return Inertia::render('backend/components/Tooltip');
    }

    public function typography()
    {
        return Inertia::render('backend/components/Typography');
    }
}
