<?php 
    // Start session
    if (session_status() == PHP_SESSION_NONE) { 
        session_start(); 
    }
    
    // Include the file containing the getCartCount() function
    include 'includes/cart_functions.php'; 
    $cart_count = getCartCount();
    
    // Get search query
    $search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
    $search_results = [];
    $results_count = 0;
    
    $all_products = [
        // Headsets 
        ['id' => 101, 'name' => 'Razer Kraken X', 'description' => '7.1 surround sound, lightweight design, bendable noise-cancelling microphone, and comfortable ear cushions.', 'price' => 2800, 'category' => 'Headsets', 'image' => 'Images/Razer Kraken X.jpg', 'page' => 'headset.php'],
        ['id' => 102, 'name' => 'Logitech G432', 'description' => 'DTS 7.1 surround sound, 6mm flip-to-mute microphone, and comfortable over-ear design for long gaming sessions.', 'price' => 2500, 'category' => 'Headsets', 'image' => 'Images/Logitech G432.jpg', 'page' => 'headset.php'],
        ['id' => 103, 'name' => 'HyperX Cloud Stinger', 'description' => 'Lightweight gaming headset with 50mm directional drivers, swivel-to-mute noise cancellation, and intuitive volume control.', 'price' => 1800, 'category' => 'Headsets', 'image' => 'Images/HyperX Cloud Stinger.jpg', 'page' => 'headset.php'],
        ['id' => 104, 'name' => 'SteelSeries Arctis 3', 'description' => 'Console-grade audio quality, ClearCast noise-cancelling microphone, and comfortable ski goggle suspension headband.', 'price' => 3000, 'category' => 'Headsets', 'image' => 'Images/SteelSeries Arctis 3.jpg', 'page' => 'headset.php'],
        ['id' => 105, 'name' => 'Rakk Kapsul', 'description' => 'Local brand favorite with 7.1 virtual surround sound, RGB lighting, and adjustable headband for maximum comfort.', 'price' => 1500, 'category' => 'Headsets', 'image' => 'Images/Rakk Kapsul.jpg', 'page' => 'headset.php'],
        ['id' => 106, 'name' => 'Fantech HG11', 'description' => '50mm high-quality drivers, omnidirectional microphone, RGB lighting effects, and soft protein ear cushions.', 'price' => 2300, 'category' => 'Headsets', 'image' => 'Images/Fantech HG11.jpg', 'page' => 'headset.php'],
        ['id' => 107, 'name' => 'Logitech G435 Wireless', 'description' => 'LIGHTSPEED and Bluetooth connectivity, built-in microphone, lightweight design, and up to 18-hour battery life.', 'price' => 3500, 'category' => 'Headsets', 'image' => 'Images/Logitech G435 Wireless.jpg', 'page' => 'headset.php'],
        ['id' => 108, 'name' => 'Corsair HS65 Surround', 'description' => 'Custom-tuned 50mm neodymium audio drivers, Dolby Audio 7.1 surround sound, and memory foam ear pads.', 'price' => 5000, 'category' => 'Headsets', 'image' => 'Images/Corsair HS65 Surround.jpg', 'page' => 'headset.php'],
        
        // Keyboards
        ['id' => 301, 'name' => 'Rakk Ilis Mechanical Keyboard', 'description' => 'Durable mechanical switches with RGB backlighting and ergonomic design.', 'price' => 2500, 'category' => 'Keyboards', 'image' => 'Images/Rakk Ilis Mechanical Keyboard.jpg', 'page' => 'keyboards.php'],
        ['id' => 302, 'name' => 'Redragon K552 Kumara', 'description' => 'Compact 87-key layout, clicky blue switches, and full RGB customization.', 'price' => 1800, 'category' => 'Keyboards', 'image' => 'Images/Redragon K552 Kumara.jpg', 'page' => 'keyboards.php'],
        ['id' => 303, 'name' => 'Logitech K845 Mechanical', 'description' => 'Slim aluminum design with quiet switches — built for comfort and productivity.', 'price' => 4500, 'category' => 'Keyboards', 'image' => 'Images/Logitech K845 Mechanical.jpg', 'page' => 'keyboards.php'],
        ['id' => 304, 'name' => 'A4Tech Bloody B500N', 'description' => 'Water-resistant design, fast optical switches, and anti-ghosting performance.', 'price' => 2200, 'category' => 'Keyboards', 'image' => 'Images/A4Tech Bloody B500N.jpg', 'page' => 'keyboards.php'],
        ['id' => 305, 'name' => 'Fantech Maxfit67 RGB', 'description' => 'Compact 65% keyboard with hot-swappable switches and customizable effects.', 'price' => 2800, 'category' => 'Keyboards', 'image' => 'Images/Fantech Maxfit67 RGB.jpg', 'page' => 'keyboards.php'],
        ['id' => 306, 'name' => 'Razer Cynosa V2', 'description' => 'Soft-touch membrane keys with full RGB lighting and dedicated media controls.', 'price' => 4800, 'category' => 'Keyboards', 'image' => 'Images/Razer Cynosa V2.jpg', 'page' => 'keyboards.php'],
        ['id' => 307, 'name' => 'Logitech K380 Wireless', 'description' => 'Multi-device Bluetooth keyboard with quiet, responsive keys and long battery life.', 'price' => 1500, 'category' => 'Keyboards', 'image' => 'Images/Logitech K380 Wireless.jpg', 'page' => 'keyboards.php'],
        ['id' => 308, 'name' => 'Royal Kludge RK61', 'description' => '60% mechanical keyboard with dual Bluetooth and USB-C connectivity.', 'price' => 3000, 'category' => 'Keyboards', 'image' => 'Images/Royal Kludge RK61.jpg', 'page' => 'keyboards.php'],
        
        // Laptops 
        ['id' => 401, 'name' => 'ASUS TUF Gaming F15', 'description' => 'Intel i7 12th Gen, RTX 3060, 16 GB RAM, 512 GB SSD — built for performance and durability.', 'price' => 90000, 'category' => 'Laptops', 'image' => 'Images/asustufgaming.jpeg', 'page' => 'laptops.php'],
        ['id' => 402, 'name' => 'MSI Bravo 15', 'description' => 'AMD Ryzen 7 with Radeon graphics for smooth multitasking and gaming.', 'price' => 75000, 'category' => 'Laptops', 'image' => 'Images/MSI Bravo 15.jpeg', 'page' => 'laptops.php'],
        ['id' => 403, 'name' => 'Lenovo Legion 5', 'description' => '144 Hz display and GeForce RTX 3050 Ti GPU for fast and fluid visuals.', 'price' => 95000, 'category' => 'Laptops', 'image' => 'Images/Lenovo Legion 5.jpg', 'page' => 'laptops.php'],
        ['id' => 404, 'name' => 'Acer Nitro 5', 'description' => 'Reliable gaming laptop with Intel Core i5 and RTX 3050 graphics.', 'price' => 65000, 'category' => 'Laptops', 'image' => 'Images/Acer Nitro 5.jpg', 'page' => 'laptops.php'],
        ['id' => 405, 'name' => 'HP Victus 15', 'description' => 'Balanced performance and sleek design, ideal for gaming or study.', 'price' => 60000, 'category' => 'Laptops', 'image' => 'Images/HP Victus 15.jpg', 'page' => 'laptops.php'],
        ['id' => 406, 'name' => 'ASUS Vivobook Pro 15', 'description' => 'Lightweight productivity laptop with AMD Ryzen 5 and NVIDIA graphics.', 'price' => 55000, 'category' => 'Laptops', 'image' => 'Images/ASUS Vivobook Pro 15.jpg', 'page' => 'laptops.php'],
        ['id' => 407, 'name' => 'Lenovo IdeaPad Gaming 3', 'description' => 'Affordable yet powerful, with Ryzen 5 and GTX 1650 GPU.', 'price' => 50000, 'category' => 'Laptops', 'image' => 'Images/Lenovo IdeaPad Gaming 3.jpg', 'page' => 'laptops.php'],
        ['id' => 408, 'name' => 'Acer Aspire 7', 'description' => 'Perfect for students and professionals — AMD Ryzen 5 with GTX 1650.', 'price' => 65000, 'category' => 'Laptops', 'image' => 'Images/Acer Aspire 7.jpg', 'page' => 'laptops.php'],
        
        // Mice 
        ['id' => 201, 'name' => 'Razer DeathAdder Essential', 'description' => '6,400 DPI optical sensor, 5 programmable buttons, and ergonomic right-handed design.', 'price' => 1200, 'category' => 'Mice', 'image' => 'Images/Razer DeathAdder Essential.jpg', 'page' => 'mice.php'],
        ['id' => 202, 'name' => 'Logitech G102 Lightsync', 'description' => '8,000 DPI sensor, RGB lighting, 6 programmable buttons with classic ambidextrous shape.', 'price' => 1200, 'category' => 'Mice', 'image' => 'Images/Logitech G102 Lightsync.jpg', 'page' => 'mice.php'],
        ['id' => 203, 'name' => 'Redragon M711 Cobra', 'description' => '10,000 DPI optical sensor, 7 programmable buttons, RGB lighting with firestorm software.', 'price' => 900, 'category' => 'Mice', 'image' => 'Images/Redragon M711 Cobra.jpg', 'page' => 'mice.php'],
        ['id' => 204, 'name' => 'SteelSeries Rival 3', 'description' => '8,500 CPI TrueMove Core sensor, 3-zone RGB lighting, 60 million click mechanical switches.', 'price' => 1300, 'category' => 'Mice', 'image' => 'Images/SteelSeries Rival 3.jpg', 'page' => 'mice.php'],
        ['id' => 205, 'name' => 'Rakk Kaptan', 'description' => 'Local favorite with 6,400 DPI, 7 programmable buttons, and durable build quality.', 'price' => 600, 'category' => 'Mice', 'image' => 'Images/Rakk Kaptan.jpg', 'page' => 'mice.php'],
        ['id' => 206, 'name' => 'Fantech X9 Thor', 'description' => '3,200 DPI optical sensor, 6 buttons, RGB breathing light, perfect for entry-level gaming.', 'price' => 500, 'category' => 'Mice', 'image' => 'Images/Fantech X9 Thor.jpg', 'page' => 'mice.php'],
        ['id' => 207, 'name' => 'Logitech G304 Lightspeed', 'description' => 'Wireless gaming mouse with 12,000 DPI HERO sensor and 250-hour battery life.', 'price' => 1500, 'category' => 'Mice', 'image' => 'Images/Logitech G304 Lightspeed.jpg', 'page' => 'mice.php'],
        ['id' => 208, 'name' => 'A4Tech Bloody V7', 'description' => '3,200 DPI with 3 adjustable levels, 7 buttons, and ergonomic comfort grip design.', 'price' => 1100, 'category' => 'Mice', 'image' => 'Images/A4Tech Bloody V7.jpg', 'page' => 'mice.php'],
        // Monitor
        ['id' => 501, 'name' => 'ASUS TUF Gaming VG249Q', 'description' => '23.8" IPS Full HD, 144Hz refresh rate, 1ms response time, and Adaptive-Sync for smooth gaming.', 'price' => 12000, 'category' => 'Monitors', 'image' => 'Images/ASUS TUF Gaming VG249Q.jpg', 'page' => 'monitor.php'],
        ['id' => 502, 'name' => 'MSI Optix G241', 'description' => '24" IPS display, 144Hz refresh rate, 1ms response, and RGB lighting with thin bezel design.', 'price' => 11500, 'category' => 'Monitors', 'image' => 'Images/MSI Optix G241.jpg', 'page' => 'monitor.php'],
        ['id' => 503, 'name' => 'Acer Nitro XV240Y', 'description' => '23.8" Full HD IPS, 165Hz refresh rate, 0.5ms response, AMD FreeSync Premium, and HDR support.', 'price' => 13000, 'category' => 'Monitors', 'image' => 'Images/Acer Nitro XV240Y.jpg', 'page' => 'monitor.php'],
        ['id' => 504, 'name' => 'Samsung Odyssey G3', 'description' => '24" curved VA panel, 144Hz refresh rate, 1ms response, and AMD FreeSync for immersive gaming.', 'price' => 12500, 'category' => 'Monitors', 'image' => 'Images/Samsung Odyssey G3.jpg', 'page' => 'monitor.php'],
        ['id' => 505, 'name' => 'ViewSonic XG2405', 'description' => '24" IPS Full HD, 144Hz, 1ms response, AMD FreeSync, and ultra-thin bezels for multi-monitor setup.', 'price' => 13500, 'category' => 'Monitors', 'image' => 'Images/ViewSonic XG2405.jpg', 'page' => 'monitor.php'],
        ['id' => 506, 'name' => 'LG 24GN650-B', 'description' => '24" IPS display, 144Hz refresh rate, 1ms response, HDR10, and sRGB 99% color gamut for accurate colors.', 'price' => 14000, 'category' => 'Monitors', 'image' => 'Images/LG 24GN650-B.jpg', 'page' => 'monitor.php'],
        ['id' => 507, 'name' => 'ASUS VP249QGR', 'description' => '23.8" IPS, 144Hz, 1ms MPRT, Adaptive-Sync, and shadow boost for better visibility in dark scenes.', 'price' => 11000, 'category' => 'Monitors', 'image' => 'Images/ASUS VP249QGR.jpg', 'page' => 'monitor.php'],
        ['id' => 508, 'name' => 'AOC 24G2E', 'description' => '23.8" IPS frameless design, 144Hz, 1ms response, AMD FreeSync, and height adjustable stand.', 'price' => 15800, 'category' => 'Monitors', 'image' => 'Images/AOC 24G2E.jpg', 'page' => 'monitor.php'],
        
        // Custom PCs
        ['id' => 601, 'name' => 'PCVerse Starter Pro', 'description' => 'AMD Ryzen 5 5600X, RTX 3060, 16GB RAM, 512GB SSD, 650W PSU - Perfect for 1080p gaming and streaming.', 'price' => 35000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Starter Pro.jpg', 'page' => 'pc.php'],
        ['id' => 602, 'name' => 'PCVerse Performance Elite', 'description' => 'Intel i5-12400F, RTX 4060, 16GB DDR4, 1TB NVMe SSD, AIO cooler - Balanced performance for gaming and work.', 'price' => 42000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Performance Elite.jpg', 'page' => 'pc.php'],
        ['id' => 603, 'name' => 'PCVerse RGB Phantom', 'description' => 'AMD Ryzen 7 5700X, RTX 4070, 32GB RAM, 1TB SSD, 750W Gold PSU, ARGB fans - Stunning visuals and power.', 'price' => 55000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse RGB Phantom.jpg', 'page' => 'pc.php'],
        ['id' => 604, 'name' => 'PCVerse Stream Master', 'description' => 'Intel i7-12700K, RTX 4060 Ti, 32GB RAM, 2TB SSD, dual monitor support - Optimized for content creators.', 'price' => 52000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Stream Master.jpg', 'page' => 'pc.php'],
        ['id' => 605, 'name' => 'PCVerse Ultimate Beast', 'description' => 'AMD Ryzen 7 7700X, RTX 4070 Ti, 32GB DDR5, 2TB NVMe, 850W PSU - High-end gaming at 1440p/4K.', 'price' => 55000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Ultimate Beast.jpg', 'page' => 'pc.php'],
        ['id' => 606, 'name' => 'PCVerse Mini Titan', 'description' => 'Intel i5-13400, RTX 4060, 16GB RAM, 1TB SSD, Mini-ITX case - Powerful performance in compact form.', 'price' => 45000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Mini Titan.jpg', 'page' => 'pc.php'],
        ['id' => 607, 'name' => 'PCVerse Pro Creator', 'description' => 'AMD Ryzen 9 5900X, RTX 4070, 64GB RAM, 2TB SSD + 4TB HDD - For video editing and 3D rendering.', 'price' => 52000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Pro Creator.jpg', 'page' => 'pc.php'],
        ['id' => 608, 'name' => 'PCVerse Neon Spectra', 'description' => 'Intel i7-13700F, RTX 4070 Super, 32GB RAM, 2TB SSD, liquid cooling, full ARGB ecosystem.', 'price' => 49000, 'category' => 'Custom PCs', 'image' => 'Images/PCVerse Neon Spectra.jpg', 'page' => 'pc.php'],
        
        // Routers
        ['id' => 701, 'name' => 'TP-Link Archer AX73', 'description' => 'Dual-band WiFi 6, 5400Mbps, 8 streams, OFDMA technology, and extensive coverage for large homes.', 'price' => 12500, 'category' => 'Routers', 'image' => 'Images/TP-Link Archer AX73.jpeg', 'page' => 'router.php'],
        ['id' => 702, 'name' => 'ASUS RT-AX82U', 'description' => 'AX5400 dual-band WiFi 6, gaming port, RGB lighting, and ASUS AiMesh support for mesh networking.', 'price' => 14500, 'category' => 'Routers', 'image' => 'Images/ASUS RT-AX82U.jpg', 'page' => 'router.php'],
        ['id' => 703, 'name' => 'Netgear Nighthawk RAX50', 'description' => 'AX5400 WiFi 6 speed, 4-stream performance, smart connect, and support for 40+ devices simultaneously.', 'price' => 12800, 'category' => 'Routers', 'image' => 'Images/Netgear Nighthawk RAX50.jpg', 'page' => 'router.php'],
        ['id' => 704, 'name' => 'TP-Link Deco X60', 'description' => 'AX3000 whole-home mesh WiFi 6 system, covers up to 5,800 sq.ft., and supports 150+ devices.', 'price' => 13500, 'category' => 'Routers', 'image' => 'Images/TP-Link Deco X60.jpg', 'page' => 'router.php'],
        ['id' => 705, 'name' => 'ASUS TUF Gaming AX5400', 'description' => 'Military-grade durability, WiFi 6, gaming acceleration, and dedicated gaming port for lag-free experience.', 'price' => 13800, 'category' => 'Routers', 'image' => 'Images/ASUS TUF Gaming AX5400.jpg', 'page' => 'router.php'],
        ['id' => 706, 'name' => 'D-Link DIR-X5460', 'description' => 'AX5400 WiFi 6 router, intelligent QoS, advanced security features, and easy setup with mobile app.', 'price' => 11500, 'category' => 'Routers', 'image' => 'Images/D-Link DIR-X5460.jpg', 'page' => 'router.php'],
        ['id' => 707, 'name' => 'Linksys Atlas Pro 6', 'description' => 'AX5400 mesh WiFi 6 system, intelligent mesh technology, and seamless roaming throughout your home.', 'price' => 14000, 'category' => 'Routers', 'image' => 'Images/Linksys Atlas Pro 6.jpg', 'page' => 'router.php'],
        ['id' => 708, 'name' => 'Xiaomi AX6000', 'description' => 'Next-gen WiFi 6 technology, 6000Mbps total speed, 6 high-performance antennas, and affordable pricing.', 'price' => 11800, 'category' => 'Routers', 'image' => 'Images/Xiaomi AX6000.jpg', 'page' => 'router.php'],
        
        // Printers 
        ['id' => 801, 'name' => 'Canon PIXMA G5700', 'description' => 'Megatank all-in-one printer with wireless connectivity, automatic duplex printing, and high-yield ink bottles.', 'price' => 12500, 'category' => 'Printers', 'image' => 'Images/Canon PIXMA G5700.jpeg', 'page' => 'printer.php'],
        ['id' => 802, 'name' => 'Epson L6290', 'description' => 'EcoTank all-in-one wireless printer with 30-page ADF, duplex printing, and Wi-Fi Direct connectivity.', 'price' => 18000, 'category' => 'Printers', 'image' => 'Images/Epson L6290.jpeg', 'page' => 'printer.php'],
        ['id' => 803, 'name' => 'Brother DCP-T425W', 'description' => 'Inkjet all-in-one printer with mega tank system, wireless printing, and mobile device compatibility.', 'price' => 11000, 'category' => 'Printers', 'image' => 'Images/Brother DCP-T425W.jpeg', 'page' => 'printer.php'],
        ['id' => 804, 'name' => 'HP LaserJet Pro MFP M148fdw', 'description' => 'Monochrome laser all-in-one with automatic duplex, 35-page ADF, wireless, and fast printing speeds.', 'price' => 19000, 'category' => 'Printers', 'image' => 'Images/HP LaserJet Pro MFP M148fdw.jpeg', 'page' => 'printer.php'],
        ['id' => 805, 'name' => 'Epson L3210', 'description' => 'EcoTank single-function printer with ultra-low cost printing, Wi-Fi connectivity, and easy refill system.', 'price' => 10000, 'category' => 'Printers', 'image' => 'Images/Epson L3210.jpeg', 'page' => 'printer.php'],
        ['id' => 806, 'name' => 'Canon PIXMA G3770', 'description' => 'Megatank all-in-one with wireless connectivity, auto duplex, and support for various paper types.', 'price' => 16200, 'category' => 'Printers', 'image' => 'Images/Canon PIXMA G3770.jpeg', 'page' => 'printer.php'],
        ['id' => 807, 'name' => 'Epson L6190', 'description' => 'EcoTank all-in-one with 30-page ADF, duplex printing, Wi-Fi Direct, and professional photo quality.', 'price' => 14500, 'category' => 'Printers', 'image' => 'Images/Epson L6190.jpeg', 'page' => 'printer.php'],
        ['id' => 808, 'name' => 'HP Smart Tank 6001', 'description' => 'Wireless all-in-one printer with high-yield ink bottles, mobile printing, and automatic document feeder.', 'price' => 14800, 'category' => 'Printers', 'image' => 'Images/HP Smart Tank 6001.jpeg', 'page' => 'printer.php'],
    ];
    
    // Process search if query exists
    if (!empty($search_query)) {
        $search_term = strtolower($search_query);
        
        foreach ($all_products as $product) {
            // Search in name, description, and category
            $name_match = stripos($product['name'], $search_term) !== false;
            $desc_match = stripos($product['description'], $search_term) !== false;
            $category_match = stripos($product['category'], $search_term) !== false;
            
            if ($name_match || $desc_match || $category_match) {
                $search_results[] = $product;
            }
        }
        
        $results_count = count($search_results);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - PCVerse</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .search-results-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .search-header {
            background: #faeccf;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-header h2 {
            color: #693F26;
            margin-bottom: 10px;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .search-form input {
            flex: 1;
            padding: 12px;
            border: 2px solid #d6c2a5;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .search-form button {
            background: #693F26;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .results-count {
            color: #3B2415;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            background: #faeccf;
            border-radius: 12px;
        }
        
        .no-results i {
            font-size: 3rem;
            color: #693F26;
            margin-bottom: 15px;
        }
        
        .search-suggestions {
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #693F26;
        }
        
        .search-suggestions h4 {
            color: #693F26;
            margin-bottom: 10px;
        }
        
        .search-suggestions ul {
            list-style: none;
            padding: 0;
        }
        
        .search-suggestions li {
            padding: 5px 0;
        }
        
        .search-suggestions a {
            color: #3B2415;
            text-decoration: none;
        }
        
        .search-suggestions a:hover {
            color: #693F26;
            text-decoration: underline;
        }
        
        .product-category {
            background: #693F26;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    
    <header class="">
        <div style="text-align: left;">
            <div class="container">
                <h1>PCVerse</h1>
                <div class="header-right">
                    <div class="search-bar">
                        <form action="search.php" method="GET" style="display: flex;">
                            <input type="text" name="q" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="hamburger-menu">
                        <div class="hamburger-icon">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="dropdown-content">
                            <a href="profile.php"><i class="fa fa-user"></i> View Profile</a>
                            <a href="update_account.php"><i class="fa fa-user-edit"></i> Update Account</a>
                            <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <ul class="menu">
            <li><a href="Home.php">Home</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="reviews.php">Reviews</a></li>    
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contact</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li>
                    <a href="#" class="welcome-link">
                        <i class="fa fa-user-circle"></i> 
                        Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </a>
                </li>
            <?php else: ?>
                <li><a href="login.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'class="active"' : ''); ?>>Login</a></li>
                <li><a href="register.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php' ? 'class="active"' : ''); ?>>Register</a></li>
            <?php endif; ?>

            <li>
                <a href="cart.php">
                    <i class="fa fa-shopping-cart"></i> 
                    Cart (<?php echo $cart_count; ?>)
                </a>
            </li>
        </ul>
    </nav>

    <div class="search-results-container">
        <div class="search-header">
            <h2><i class="fa fa-search"></i> Search Results</h2>
            <form class="search-form" action="search.php" method="GET">
                <input type="text" name="q" placeholder="Search for products..." value="<?php echo htmlspecialchars($search_query); ?>" required>
                <button type="submit"><i class="fa fa-search"></i> Search</button>
            </form>
        </div>
        
        <?php if (!empty($search_query)): ?>
            <div class="results-count">
                Found <?php echo $results_count; ?> result(s) for "<?php echo htmlspecialchars($search_query); ?>"
            </div>
            
            <?php if ($results_count > 0): ?>
                <div class="content-container">
                    <?php foreach ($search_results as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='Images/default.jpg'">
                        <div class="product-category"><?php echo htmlspecialchars($product['category']); ?></div>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <h4>₱<?php echo number_format($product['price'], 2); ?></h4>
                        <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>, '<?php echo addslashes($product['image']); ?>')">Add to Cart</button>
                        <button onclick="window.location.href='<?php echo $product['page']; ?>'" style="background: #8B7355; margin-top: 5px;">View Category</button>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <i class="fa fa-search"></i>
                    <h3>No products found</h3>
                    <p>We couldn't find any products matching "<?php echo htmlspecialchars($search_query); ?>"</p>
                    
                    <div class="search-suggestions">
                        <h4>Search Suggestions:</h4>
                        <ul>
                            <li>• Check your spelling</li>
                            <li>• Try more general keywords</li>
                            <li>• Browse by <a href="product.php">category</a></li>
                            <li>• View <a href="product.php">all products</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="no-results">
                <i class="fa fa-search"></i>
                <h3>Enter a search term</h3>
                <p>Please enter what you're looking for in the search box above.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <h3>PCVerse</h3>
                <p>Your trusted gateway to technology. Explore the best laptops, accessories, and PC builds tailored to your needs.</p>
            </div>

            <div class="footer-contact">
                <h4>Contact Us</h4>
                <p><i class="fa fa-map-marker"></i> Janssen Heights, Dampas District, Tagbilaran City</p>
                <p><i class="fa fa-phone"></i> +63 912 345 6789</p>
                <p><i class="fa fa-envelope"></i> PCverse@gmail.com</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 PCVerse. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>