{{-- File Preview Component --}}
@props(['filePath', 'fileName' => null, 'showActions' => true, 'size' => 'md'])

@php
    $fileName = $fileName ?: basename($filePath ?? '');
    $extension = pathinfo($filePath ?? '', PATHINFO_EXTENSION);
    $fileUrl = $filePath ? asset('storage/' . $filePath) : null;
    
    $sizeClasses = [
        'sm' => 'w-50px h-50px',
        'md' => 'w-75px h-75px', 
        'lg' => 'w-100px h-100px',
        'xl' => 'w-150px h-150px'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

@if($filePath && $fileUrl)
    <div class="file-preview d-flex flex-column align-items-center">
        <!--begin::File Icon/Preview-->
        <div class="file-icon {{ $sizeClass }} d-flex align-items-center justify-content-center bg-light rounded position-relative mb-3">
            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                {{-- Image Preview --}}
                <img src="{{ $fileUrl }}" 
                     alt="{{ $fileName }}" 
                     class="img-fluid rounded {{ $sizeClass }}"
                     style="object-fit: cover;"
                     onclick="openFileModal('{{ $fileUrl }}', '{{ $fileName }}', 'image')" 
                     role="button" />
            @elseif(strtolower($extension) === 'pdf')
                {{-- PDF Preview --}}
                <div class="text-center" onclick="openFileModal('{{ $fileUrl }}', '{{ $fileName }}', 'pdf')" role="button">
                    <i class="fas fa-file-pdf text-danger fs-2x"></i>
                    <div class="text-muted fs-7 mt-1">PDF</div>
                </div>
            @else
                {{-- Generic File Icon --}}
                <div class="text-center">
                    @switch(strtolower($extension))
                        @case('doc')
                        @case('docx')
                            <i class="fas fa-file-word text-primary fs-2x"></i>
                            <div class="text-muted fs-7 mt-1">DOC</div>
                            @break
                        @case('xls')
                        @case('xlsx')
                            <i class="fas fa-file-excel text-success fs-2x"></i>
                            <div class="text-muted fs-7 mt-1">XLS</div>
                            @break
                        @case('zip')
                        @case('rar')
                            <i class="fas fa-file-archive text-warning fs-2x"></i>
                            <div class="text-muted fs-7 mt-1">ZIP</div>
                            @break
                        @default
                            <i class="fas fa-file text-muted fs-2x"></i>
                            <div class="text-muted fs-7 mt-1">{{ strtoupper($extension) }}</div>
                    @endswitch
                </div>
            @endif
            
            {{-- File size badge --}}
            <span class="badge badge-light-primary position-absolute top-0 end-0 fs-8">
                {{ app(\App\Services\FileManagerService::class)->getFileSize($filePath) }}
            </span>
        </div>
        <!--end::File Icon/Preview-->

        <!--begin::File Name-->
        <div class="text-center">
            <div class="fw-bold text-gray-800 fs-7 mb-1" title="{{ $fileName }}">
                {{ Str::limit($fileName, 20) }}
            </div>
            <div class="text-muted fs-8">.{{ $extension }}</div>
        </div>
        <!--end::File Name-->

        <!--begin::Actions-->
        @if($showActions)
            <div class="file-actions mt-3 d-flex gap-2">
                {{-- Preview/View Button --}}
                @if(in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif']))
                    <button type="button" 
                            class="btn btn-sm btn-light-primary" 
                            onclick="openFileModal('{{ $fileUrl }}', '{{ $fileName }}', '{{ in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'pdf' }}')"
                            title="{{ __('documents.view_file') }}">
                        <i class="fas fa-eye fs-7"></i>
                    </button>
                @endif

                {{-- Download Button --}}
                <a href="{{ route('admin.files.download', ['path' => $filePath, 'name' => $fileName]) }}" 
                   class="btn btn-sm btn-light-success"
                   title="{{ __('documents.download_file') }}">
                    <i class="fas fa-download fs-7"></i>
                </a>

                {{-- Info Button --}}
                <button type="button" 
                        class="btn btn-sm btn-light-info" 
                        onclick="showFileInfo('{{ $filePath }}')"
                        title="{{ __('File Information') }}">
                    <i class="fas fa-info fs-7"></i>
                </button>
            </div>
        @endif
        <!--end::Actions-->
    </div>
@else
    {{-- No File State --}}
    <div class="file-preview d-flex flex-column align-items-center">
        <div class="file-icon {{ $sizeClass }} d-flex align-items-center justify-content-center bg-light rounded mb-3">
            <div class="text-center">
                <i class="fas fa-file-slash text-muted fs-2x"></i>
                <div class="text-muted fs-7 mt-1">{{ __('No File') }}</div>
            </div>
        </div>
        <div class="text-center">
            <div class="text-muted fs-7">{{ __('documents.no_file_uploaded') }}</div>
        </div>
    </div>
@endif

{{-- File Modal for Preview --}}
@push('modals')
<div class="modal fade" id="file-preview-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file-preview-title">{{ __('documents.file_preview') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="file-preview-body">
                <!-- File content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <a id="file-download-link" href="#" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download"></i> {{ __('documents.download_file') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
// File preview functionality
function openFileModal(fileUrl, fileName, type) {
    const modal = new bootstrap.Modal(document.getElementById('file-preview-modal'));
    const title = document.getElementById('file-preview-title');
    const body = document.getElementById('file-preview-body');
    const downloadLink = document.getElementById('file-download-link');
    
    title.textContent = fileName;
    downloadLink.href = fileUrl;
    
    // Clear previous content
    body.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    
    if (type === 'image') {
        body.innerHTML = `<img src="${fileUrl}" alt="${fileName}" class="img-fluid rounded shadow" style="max-height: 70vh;">`;
    } else if (type === 'pdf') {
        body.innerHTML = `<iframe src="${fileUrl}" width="100%" height="600px" frameborder="0"></iframe>`;
    } else {
        body.innerHTML = `<div class="text-center"><i class="fas fa-file fs-3x text-muted mb-3"></i><br><p>{{ __('documents.file_cannot_preview') }}</p></div>`;
    }
    
    modal.show();
}

// Show file information
function showFileInfo(filePath) {
    fetch(`{{ route('admin.files.info') }}?path=${encodeURIComponent(filePath)}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                showError(data.error);
                return;
            }
            
            const info = `
                <strong>{{ __('documents.file_size') }}:</strong> ${data.size}<br>
                <strong>{{ __('documents.file_type') }}:</strong> ${data.mime_type}<br>
                <strong>{{ __('Last Modified') }}:</strong> ${new Date(data.last_modified * 1000).toLocaleDateString()}<br>
                <strong>{{ __('Can Preview') }}:</strong> ${data.can_preview ? '{{ __('Yes') }}' : '{{ __('No') }}'}
            `;
            
            Swal.fire({
                title: '{{ __('File Information') }}',
                html: info,
                icon: 'info',
                confirmButtonText: '{{ __('Close') }}'
            });
        })
        .catch(error => {
            showError('{{ __('Error loading file information') }}');
        });
}
</script>
@endpush
