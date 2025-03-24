@extends('layouts.app')
@section('title')
Booking Details
@endsection


@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>


<section x-data="handleBookingSections()" class="max-w-[1110px] w-[90vw] mx-auto my-4">
     <!-- Bar Section -->
     
     <div class="flex items-center justify-between my-3 gap-2">
         <div class="flex items-center gap-2 w-[45%]">
             <p class="bg-[#008000] rounded-full px-2 text-md text-white">1</p>
             <p class="md:text-sm text-xs font-bold text-[#1a1a1a]">Your Selection</p>
         </div>
         <p class="h-[2px] bg-black w-full"></p>
         <div class="flex items-center gap-1 w-[45%]">
             <p class="bg-[#008000] rounded-full px-2 text-md text-white">2</p>
             <p class="md:text-sm text-xs font-bold text-[#1a1a1a]">Your Details</p>
         </div>
         <p class="h-[2px] bg-black w-full"></p>
         <div class="flex items-center gap-1 w-[45%]">
             <p :class="open == 'finish' ?  'bg-[#008000] text-white' : 'border-[1px] border-[#1a1a1a]'" class="rounded-full px-2 text-md ">3</p>
             <p class="md:text-sm text-xs font-bold text-[#1a1a1a]">Finish booking</p>
         </div>
     </div>
     
     <!-- Bar Section End-->
     
     <!-- Main Section Start-->
     <div class="md:grid md:grid-cols-12 gap-4 mt-4">
         <!-- Sidebar Start-->
         <div class="col-span-4">
             <!-- BOX 1-->
             <div class="border-[1px] border-gray-300 p-3">
                  <div class="flex items-center gap-2">
                      <p class="text-xs text-[#1a1a1a] font-normal">Tour</p>
                      <div class="flex items-center gap-[1px]">
                          <i class="material-icons text-yellow-600 text-sm">star</i>
                          <i class="material-icons text-yellow-600 text-sm">star</i>
                          <i class="material-icons text-yellow-600 text-sm">star</i>
                      </div>
                      <div class="bg-yellow-600 px-[10px]">
                          <i class="material-icons text-white text-xs">thumb_up</i>
                      </div>
                  </div>
                  <div class="my-2">
                      <h3 class="font-bold text-md text-[#1a1a1a]">Trip To Azad Kashmir</h3>
                      <p class="font-normal text-sm mt-2">Azad Kashmir is abundant in tourists from the ancient Buddhist University’s remains in Sharda.</p>
                      <p class="mt-2 text-[#008000] text-xs">Great Location... 8.1</p>
                  </div>
                  <div class="my-2 flex items-center gap-2">
                      <div class="bg-[#008000] p-1 text-sm text-white">7.4</div>
                      <p class="font-normal text-[#1a1a1a] text-xs">Good 70 real reviews</p>
                  </div>
             </div>
                <!-- BOX 2-->
             <div class="border-[1px] border-gray-300 p-3 mt-3">
                <h3 class="font-bold text-md text-[#1a1a1a]">Your booking details</h3>
                 <div class="grid grid-cols-2 gap-2 mt-3">
                     <div>
                         <p class="text-sm text-[#1a1a1a]">Departure</p>
                         <p class="text-md font-bold text-[#1a1a1a]">Mar 12, 2025</p>
                     </div>
                     <div>
                         <p class="text-sm text-[#1a1a1a]">Arrive</p>
                         <p class="text-md font-bold text-[#1a1a1a]">Mar 13, 2025</p>
                     </div>
                 </div>
                 <p class="text-sm font-semibold text-[#1a1a1a] mt-3">Total length of stay:</p>
                 <p class="text-sm font-bold text-[#1a1a1a] mt-2">2 days 1 night </p>
             </div>
               <!-- BOX 3-->
            <div class="border-[1px] border-gray-300 p-3">
                <p class="font-semibold text-sm text-[#1a1a1a]">You Selected</p>
                <p class="font-bold text-md text-[#1a1a1a]">Single 2 kids ( Below 3 years )</p>
                <p class="font-normal text-sm text-[#008000] mt-2">Change your selection</p>
             </div>
               <!-- BOX 4-->
            <div class="border-[1px] border-gray-300 p-3 mt-3">
                <p class="font-bold text-md text-[#1a1a1a]">Your Price Summary</p>
                <div class="grid grid-cols-12 gap-2 mt-2">
                    <div class="col-span-9"><p class="font-normal text-sm text-[#1a1a1a]">Original Price</p></div>
                    <div class="col-span-3"><p class="font-normal text-sm text-[#1a1a1a] ps-2">PKR 6,000</p></div>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-2">
                    <div class="col-span-9">
                        <p class="font-normal text-sm text-[#1a1a1a]">Early 2025 Deal</p>
                        <p class="font-normal text-xs text-[#6b6b6b]">This property is offering a discount on stays between Jan 1 and Apr 1, 2025.</p>
                    </div>
                    <div class="col-span-3"><p class="font-normal text-sm text-[#1a1a1a]">- PKR 1,320</p></div>
                </div>
                <div class="grid grid-cols-12 gap-2 mt-2">
                    <div class="col-span-9">
                        <p class="font-normal text-sm text-[#1a1a1a]">Genius Discount</p>
                        <p class="font-normal text-xs text-[#6b6b6b]">You’re getting a reduced rate because you’re a Genius member.</p>
                    </div>
                    <div class="col-span-3"><p class="font-normal text-sm text-[#1a1a1a]">- PKR 720</p></div>
                </div>
             </div>
               <!-- BOX 5-->
            <div class="border-[1px] border-gray-300 bg-blue-50 p-3 ">
                    <div class="grid grid-cols-2">
                        <div class="flex items-center">
                          <p class="text-2xl text-[#1a1a1a] font-bold">Price</p>
                        </div>
                        <div>
                            <div class="text-end">
                             <del class="text-red-500 text-[#1a1a1a] ms-auto">PKR 6,000</del>
                            </div>
                            <p class="text-2xl font-bold text-[#1a1a1a] text-end">PKR 3,960</p>
                            <p class="text-sm font-normal text-[#6b6b6b] text-end">+PKR 634 taxes and fees</p>
                        </div>
                    </div>
             </div>
               <!-- BOX 6-->
            <div class="border-[1px] border-gray-300 p-3 ">
                    <h3 class="font-bold text-md text-[#1a1a1a]">Price information</h3>
                    <div class="flex items-center mt-3 gap-3">
                      <p class="font-semibold text-md">PKR</p>
                        <div class="w-full">
                            <p class="text-sm font-normal text-[#6b6b6b]">Excludes PKR 633.60 in taxes and fees</p>
                            <div class="flex justify-between mt-2">
                                <p class="text-sm font-normal text-[#6b6b6b]">16 % TAX</p>
                                <p class="text-sm font-normal text-[#6b6b6b]">PKR 633.60</p>
                            </div>
                        </div>
                    </div>
             </div>
               <!-- BOX 7-->
            <div class="border-[1px] border-gray-300 p-3 mt-3">
                    <h3 class="font-bold text-md text-[#1a1a1a]">Your payment schedule</h3>
                    <p class="text-sm font-normal text-[#008000] mt-2">No payment today. You'll pay when you stay.</p>
             </div>
               <!-- BOX 8-->
            <div class="border-[1px] border-gray-300 p-3 mt-3">
                    <h3 class="font-bold text-md text-[#1a1a1a]">How much will it cost to cancel?</h3>
                    <p class="text-sm font-normal text-[#008000] mt-2">Free cancellation before 6:00 PM on Mar 12</p>
                    <div class="flex justify-between mt-2">
                        <p class="text-sm font-normal text-[#6b6b6b]">After 6:00 PM on Mar 12</p>
                        <p class="text-sm font-normal text-[#6b6b6b]">PKR 3,960</p>
                    </div>
             </div>
         </div>
         <!-- Sidebar End-->
         
         <!--  Detail Section Start-->
         <div class="col-span-8">
            <form id="form" >
                 <!-- Section 1 START -->
                 <div x-show="open == 'your_details'">
                     <!--Box 1-->
                     <div class="border-[1px] p-3 border-gray-300 flex items-center gap-3">
                         <div>
                             <img src="#" alt="img" class="rounded-full border-[2px] border-[#008000]" />
                         </div>
                         <div>
                             <h3 class="text-md font-bold text-[#1a1a1a]">You are signed in</h3>
                             <p class="text-sm font-normal text-[#6b6b6b]">test@gmail.com</p>
                         </div>
                     </div>
                     <!--Box 2-->
                    <div class="mt-3">
                            <!--Form Box 1-->
                            <div class="border border-gray-300 p-3 space-y-4">
                                
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Enter Your Details</h3>
        
                                <div class="md:grid md:grid-cols-2 gap-3">
                                    <!-- First Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="John">
                                    </div>
                            
                                    <!-- Last Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Doe">
                                    </div>
                                </div>
                        
                                <!-- Email Address -->
                                <div class="flex flex-col">
                                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" class="md:w-[49%] border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="example@email.com">
                                </div>
                        
                                <!-- Country/Region Select -->
                                <div class="flex flex-col">
                                    <label class="block text-sm font-medium text-gray-700">Country/Region</label>
                                    <select class="md:w-[49%] border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                        <option value="">Select your country</option>
                                        <option selected value="us">Pakistan</option>
                                    </select>
                                </div>
                        
                                <!-- Phone Number -->
                                <div class="flex flex-col">
                                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="tel" class="md:w-[49%] border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="+92">
                                </div>
                        
                                <!-- Checkbox -->
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="agree" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-2 focus:ring-green-500">
                                    <label for="agree" class="text-sm text-gray-700 p-0 m-0">I agree to the terms and conditions</label>
                                </div>
                        
                            </div>
                            
                            <!--Form Box 2-->
                            <div class="border border-gray-300 p-3 space-y-3 mt-3">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Good to know:</h3>
                                <div class="flex items-center gap-2">
                                    <i class="material-icons rounded-full border-[1px] border-[#008000] text-[#008000] px-1 text-sm">check</i>
                                    <p class="text-sm font-normal text-[#1a1a1a]">No credit card needed</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="material-icons rounded-full border-[1px] border-[#008000] text-[#008000] px-1 text-sm">check</i>
                                    <p class="text-sm font-normal text-[#1a1a1a]">Stay flexible: You can cancel for free before 6:00 PM on March 12, 2025, so lock in this great price today.</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="material-icons rounded-full border-[1px] border-[#008000] text-[#008000] px-1 text-sm">check</i>
                                    <p class="text-sm font-normal text-[#1a1a1a]">No payment is required to secure this booking. You'll pay during your stay.</p>
                                </div>
                            </div>
                            
                            <!--Form Box 3-->
                            <div class="border border-gray-300 p-3 space-y-6 mt-3">
                                <!-- Select Package -->
                                <h3 class="text-lg font-bold text-gray-800">Select Package</h3>
                                      <div class="flex items-center gap-3">
                                        <div class="flex items-center gap-2 p-0">
                                            <input type="radio" x-model="package" selected value="Single" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500">
                                            <span class="text-gray-700">Single</span>
                                        </div>
                                        <div class="flex items-center gap-2 p-0">
                                            <input type="radio" x-model="package" value="Couple" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500">
                                            <span class="text-gray-700">Couple</span>
                                        </div>
                                        <div class="flex items-center gap-2 p-0">
                                            <input type="radio" x-model="package" value="Family" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500">
                                            <span class="text-gray-700">Family</span>
                                        </div>
                                    </div>
                            
                                <!-- Select Persons -->
                                <h3 class="text-lg font-bold text-gray-800">Select Persons</h3>
                                <div  class="space-y-4">
                                    <!-- Below 3 Years -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700">Below 3 Years</span>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="below_three--" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">-</button>
                                            <span class="text-lg font-semibold" x-text="below_three"></span>
                                            <button type="button" @click="below_three++" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">+</button>
                                        </div>
                                    </div>
                            
                                    <!-- Between 3-8 Years -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700">Between 3 - 8 Years</span>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="between_three_eight--" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">-</button>
                                            <span class="text-lg font-semibold" x-text="between_three_eight"></span>
                                            <button type="button" @click="between_three_eight++" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">+</button>
                                        </div>
                                    </div>
                            
                                    <!-- Above 8 Years -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700">Above 8 Years</span>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="above_eight--" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">-</button>
                                            <span class="text-lg font-semibold" x-text="above_eight"></span>
                                            <button type="button" @click="above_eight++" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <button @click="open = 'finish'; $nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))" 
                                            type="button" 
                                            class="w-full mt-3 bg-[#008000] text-white p-2 rounded-md hover:bg-green-600 transition">
                                        Next: Final details
                                    </button>
                    </div>
                 </div>
                <!-- Section 1  END -->
                
                <!-- Section 2 Start-->
                
                <div  x-show="open == 'finish'">
                     <div class="border border-gray-300 p-3 space-y-2">
                         <div class="flex items-center justify-between">
                           <h3 class="text-lg font-bold text-gray-800">Package</h3>
                             <p x-text="package" class="text-md font-normal text-[#1a1a1a]"></p>
                         </div>
                         <div class="flex items-center justify-between">
                           <h3 class="text-md font-normal text-[#1a1a1a]">Under 3 Years:</h3>
                             <p x-text="below_three" class="text-md font-normal text-[#1a1a1a]"></p>
                         </div>
                         <div class="flex items-center justify-between">
                           <h3 class="text-md font-normal text-[#1a1a1a]">Between 3-8 Years:</h3>
                             <p x-text="between_three_eight" class="text-md font-normal text-[#1a1a1a]"></p>
                         </div>
                         <div class="flex items-center justify-between">
                           <h3 class="text-md font-normal text-[#1a1a1a]">Above 8 Years:</h3>
                             <p x-text="above_eight" class="text-md font-normal text-[#1a1a1a]"></p>
                         </div>
                        <div class=" rounded-lg flex flex-col gap-2 justify-center pt-2 border-t-[3px]">
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="" name="payment-type"
                                    class="w-4 h-4 text-[#008000] bg-gray-100 border-gray-300 focus:ring-[#008000] dark:focus:ring-[#008000] dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                <label for="default-radio-1"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pay 20% for confirm
                                    booking</label>
                            </div>
                            <div class="flex items-center">
                                <input checked id="default-radio-2" type="radio" value="" name="payment-type"
                                    class="w-4 h-4 text-[#008000] bg-gray-100 border-gray-300 focus:ring-[#008000] dark:focus:ring-[#008000] dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                <label for="default-radio-2"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Make Full
                                    Payment</label>
                            </div>
                         </div>
                     </div>
                     <div x-data="{ paymentMethod: 'jazzcash' }" class="border border-gray-300 p-4 space-y-4 mt-3">
                        <h3 class="text-lg font-bold text-gray-800">Select Payment Method</h3>
                    
                        <!-- Payment Method Selection (Clickable Images) -->
                        <div class="grid grid-cols-3 gap-4">
                            <img src="https://digitalpakistan.pk/wp-content/uploads/2021/09/JazzCash-1.jpg" alt="JazzCash" class="w-[100px] md:h-[80px] h-auto rounded-xl border cursor-pointer"
                                :class="{ 'border-green-500': paymentMethod === 'jazzcash' }"
                                @click="paymentMethod = 'jazzcash'">
                            
                            <img src="https://www.completesports.com/wp-content/uploads/2024/03/easypaisa.jpg" alt="EasyPaisa" class="w-[100px] md:h-[80px] h-auto rounded-xl border cursor-pointer"
                                :class="{ 'border-green-500': paymentMethod === 'easypaisa' }"
                                @click="paymentMethod = 'easypaisa'">
                            
                            <img src="https://t4.ftcdn.net/jpg/00/61/06/27/360_F_61062796_NF87GPnWV0fQ2LhoYNlyjev0PocRwZj9.jpg" alt="Bank Transfer" class="w-[100px] md:h-[80px] h-auto rounded-xl border cursor-pointer"
                                :class="{ 'border-green-500': paymentMethod === 'bank' }"
                                @click="paymentMethod = 'bank'">
                        </div>
                    
                        <!-- Dynamic Input Field Based on Selection -->
                        <div x-show="paymentMethod" class="mt-3">
                            <label class="block text-gray-700 text-sm font-semibold mb-1" x-text="
                                paymentMethod === 'jazzcash' ? 'Please provide your JazzCash account number' :
                                paymentMethod === 'easypaisa' ? 'Please provide your EasyPaisa account number' :
                                'Please provide your Bank Account Number'
                            "></label>
                            <input type="text" placeholder="Enter account number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-2 focus:ring-green-500" />
                            <p class="text-sm font-normal text-[#1a1a1a]">Your booking is directly with Gold Crest Lahore and by completing this booking you agree to the <span class="text-[#008000]"> booking conditions </span>, <span class="text-[#008000]"> general terms </span>, and <span class="text-[#008000]">privacy policy</span>.</p>
                        </div>
                        <div class="w-full flex justify-center">
                            <div class="w-[200px] flex justify-center">
                                <!--<a href="{{ route('payment', $id) }}" class="w-full text-decoration-none">-->
                                    <button
                                         type="button"
                                         @click="open_model = true"
                                        class="focus:outline-none text-center text-white bg-[#008000] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-full w-full text-base lg:text-xl px-4 lg:px-5 py-2 lg:py-2.5 my-3">
                                        Make Payment
                                    </button>
                                <!--</a>-->
                            </div>
                    </div>
                    </div>

                </div>
                
                <!-- Section 2 End-->
            </form>
         </div>
         <!-- Detail Section End-->
     </div>
     <!-- Main Section End-->
     
     <!-- Modal Start -->
     
    <!-- Modal -->
<div>

    <div style="display:none" x-show="open_model" x-transition class="fixed inset-0 flex items-center justify-center z-[999]">
        <!-- Background Overlay -->
        <div x-show="open_model" x-transition.opacity 
             class="fixed inset-0 bg-black bg-opacity-50 z-[-1]" 
             @click="open_model = false">
        </div>

        <!-- Modal Box -->
        <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-2">
                <h3 class="text-lg font-semibold text-gray-800">Upload Payment Receipt</h3>
                <button @click="open_model = false" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <!-- Upload Area -->
            <div class="mt-2 text-center">
                <label for="file-upload" class="border contents border-gray-300 p-4 rounded-lg flex flex-col items-center justify-center text-center cursor-pointer hover:border-green-500 transition duration-200 bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 12v4m0 0v4m0-4h4m-4 0h-4"></path>
                        <path d="M5 20h14a2 2 0 002-2V7a2 2 0 00-2-2h-3l-2-2h-4l-2 2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                    </svg>
                    <input type="file" id="file-upload" class="hidden" @change="console.log($event.target.files[0])">
                    <span class="text-sm text-gray-600">Click to upload or drag & drop</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3 mt-4">
                <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Submit</button>
            </div>
        </div>
    </div>
</div>

     
     <!-- Modal End-->
</section>

<script>
    
    function handleBookingSections(){
        return {
            open : 'your_details',
            open_model : false,
            package: 'Single',
            below_three : '0',
            between_three_eight : '0',
            above_eight : '0'
        }
    }
</script>

@endsection