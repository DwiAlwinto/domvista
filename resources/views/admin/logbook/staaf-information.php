 <div class="container-xl">
           <div class="col-md-12">
            <!-- Enhanced Staff Information Card -->
            <div class="card card-lg mt-4">
                <div class="card-header bg-azure-lt">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                        Staff Information
                    </h3>
                </div>
                <div class="card-body">
                    <div class="divide-y">
                        <!-- Management Row -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-blue text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h.5" />
                                            <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Manager on Duty</div>
                                        <div class="h4">{{ $logbook->staff->mod }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-purple text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2" />
                                            <path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Chief Tenant Relation</div>
                                        <div class="h4">{{ $logbook->staff->chief_tr }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tenant Relations Row -->
                        <div class="row g-3 pt-3">
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-orange text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sunrise" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
                                            <path d="M3 21l18 0" />
                                            <path d="M12 9v-6l3 3m-6 0l3 -3" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Tenant Relation Morning</div>
                                        <div class="h5">{{ $logbook->staff->c_morning }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-yellow text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Tenant Relation Afternoon</div>
                                        <div class="h5">{{ $logbook->staff->c_afternoon }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-indigo text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-moon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Tenant Relation Evening</div>
                                        <div class="h5">{{ $logbook->staff->c_evening }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Support Staff Row -->
                        <div class="row g-3 pt-3">
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-red text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                                            <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 12l0 2.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Security Lobby</div>
                                        <div class="h5">{{ $logbook->staff->security_loby }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-teal text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-broom" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12v1a19 19 0 0 0 19 0v-1" />
                                            <path d="M3 6v1a19 19 0 0 0 19 0v-1" />
                                            <path d="M5 10c1.333 -1.333 2.667 -2 4 -2c1.333 0 2.667 .667 4 2" />
                                            <path d="M19 10c-1.333 -1.333 -2.667 -2 -4 -2c-1.333 0 -2.667 .667 -4 2" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Housekeeping Lobby</div>
                                        <div class="h5">{{ $logbook->staff->hk_loby }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex align-items-center">
                                    <span class="avatar avatar-md bg-pink text-white d-flex align-items-center justify-content-center me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dumbbell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 8v-3a1 1 0 0 1 1 -1h3m4 0h3a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-3m-4 0h-3a1 1 0 0 1 -1 -1v-3" />
                                            <path d="M20 21l-4 -4" />
                                            <path d="M16 17l4 4" />
                                            <path d="M4 4l4 4" />
                                            <path d="M8 8l-4 -4" />
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted mb-1">Health Club</div>
                                        <div class="h5">{{ $logbook->staff->hc }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Performance Alert -->
                    <div class="mt-4">
                        <div class="alert alert-success d-flex align-items-center">
                            <span class="avatar avatar-sm bg-success-lt rounded-circle me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 14l2 -2m0 0l2 -2m-2 2l-2 -2m2 2l2 2m7 -2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
                                </svg>
                            </span>
                            <div class="flex-fill">
                                <h4 class="alert-title">Staff Performance Summary</h4>
                                <div class="text-muted">
                                    All staff members are performing according to schedule with no reported issues.
                                    <span class="text-success">100% attendance</span> recorded for this period.
                                </div>
                            </div>
                            <button class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            </div>
          </div>