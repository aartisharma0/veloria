@extends('layouts.app')
@section('title', 'Size Guide')

@section('content')
<div class="container py-5" style="max-width:850px;">
    <h2 class="fw-bold mb-4" style="font-family:'Playfair Display',serif;">Size Guide</h2>
    <p class="text-muted mb-4">Find your perfect fit. All measurements are in <strong>inches</strong>.</p>

    {{-- Women --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold"><i class="bi bi-gender-female me-2" style="color:var(--veloria-primary);"></i>Women's Clothing</h5></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center">
                    <thead class="table-light"><tr><th>Size</th><th>Bust</th><th>Waist</th><th>Hips</th><th>US</th><th>UK</th></tr></thead>
                    <tbody>
                        <tr><td class="fw-semibold">XS</td><td>31-32</td><td>24-25</td><td>34-35</td><td>0-2</td><td>4-6</td></tr>
                        <tr><td class="fw-semibold">S</td><td>33-34</td><td>26-27</td><td>36-37</td><td>4-6</td><td>8-10</td></tr>
                        <tr style="background:var(--veloria-pink-soft);"><td class="fw-semibold">M</td><td>35-36</td><td>28-29</td><td>38-39</td><td>8-10</td><td>12-14</td></tr>
                        <tr><td class="fw-semibold">L</td><td>37-39</td><td>30-32</td><td>40-42</td><td>12-14</td><td>16-18</td></tr>
                        <tr><td class="fw-semibold">XL</td><td>40-42</td><td>33-35</td><td>43-45</td><td>16-18</td><td>20-22</td></tr>
                        <tr><td class="fw-semibold">XXL</td><td>43-45</td><td>36-38</td><td>46-48</td><td>20-22</td><td>24-26</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Men --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold"><i class="bi bi-gender-male me-2" style="color:var(--veloria-primary);"></i>Men's Clothing</h5></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center">
                    <thead class="table-light"><tr><th>Size</th><th>Chest</th><th>Waist</th><th>Neck</th><th>US</th><th>UK</th></tr></thead>
                    <tbody>
                        <tr><td class="fw-semibold">S</td><td>36-38</td><td>30-32</td><td>14.5</td><td>34-36</td><td>34-36</td></tr>
                        <tr style="background:var(--veloria-pink-soft);"><td class="fw-semibold">M</td><td>39-41</td><td>33-35</td><td>15-15.5</td><td>38-40</td><td>38-40</td></tr>
                        <tr><td class="fw-semibold">L</td><td>42-44</td><td>36-38</td><td>16-16.5</td><td>42-44</td><td>42-44</td></tr>
                        <tr><td class="fw-semibold">XL</td><td>45-47</td><td>39-42</td><td>17</td><td>46-48</td><td>46-48</td></tr>
                        <tr><td class="fw-semibold">XXL</td><td>48-50</td><td>43-46</td><td>17.5</td><td>50-52</td><td>50-52</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footwear --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white"><h5 class="mb-0 fw-bold"><i class="bi bi-boot me-2" style="color:var(--veloria-primary);"></i>Footwear</h5></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center">
                    <thead class="table-light"><tr><th>UK</th><th>US (Men)</th><th>US (Women)</th><th>EU</th><th>Foot Length (cm)</th></tr></thead>
                    <tbody>
                        <tr><td class="fw-semibold">6</td><td>7</td><td>8</td><td>39</td><td>24.5</td></tr>
                        <tr><td class="fw-semibold">7</td><td>8</td><td>9</td><td>40</td><td>25.4</td></tr>
                        <tr style="background:var(--veloria-pink-soft);"><td class="fw-semibold">8</td><td>9</td><td>10</td><td>42</td><td>26.2</td></tr>
                        <tr><td class="fw-semibold">9</td><td>10</td><td>11</td><td>43</td><td>27.1</td></tr>
                        <tr><td class="fw-semibold">10</td><td>11</td><td>12</td><td>44</td><td>27.9</td></tr>
                        <tr><td class="fw-semibold">11</td><td>12</td><td>13</td><td>45</td><td>28.8</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-rulers me-2" style="color:var(--veloria-primary);"></i>How to Measure</h5>
            <div class="row g-3">
                <div class="col-md-4 text-center">
                    <div class="p-3 rounded" style="background:var(--veloria-pink-soft);">
                        <i class="bi bi-arrows-expand fs-3" style="color:var(--veloria-primary);"></i>
                        <h6 class="fw-bold mt-2">Bust/Chest</h6>
                        <small class="text-muted">Measure around the fullest part of your chest</small>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 rounded" style="background:var(--veloria-pink-soft);">
                        <i class="bi bi-arrows-collapse fs-3" style="color:var(--veloria-primary);"></i>
                        <h6 class="fw-bold mt-2">Waist</h6>
                        <small class="text-muted">Measure around your natural waistline</small>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-3 rounded" style="background:var(--veloria-pink-soft);">
                        <i class="bi bi-arrows-fullscreen fs-3" style="color:var(--veloria-primary);"></i>
                        <h6 class="fw-bold mt-2">Hips</h6>
                        <small class="text-muted">Measure around the widest part of your hips</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
