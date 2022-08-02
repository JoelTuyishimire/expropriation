<div class="card shadow-none">
    <div class="card-body">
        <div class="accordion my-4 accordion-toggle-arrow" id="accordionExample1">
            <div class="card rounded-0 border-lisght shadow-none">
                <div class="card-header">
                    <div class="card-title collapsed text-warning" data-toggle="collapse"
                         data-target="#collapseTwo1">
                        <i class="flaticon-star text-warning"></i> Reviews
                        ({{$histories->where("is_comment",1)->count() }})
                    </div>
                </div>
                <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                    <div class="card-body">
                        <div class="timeline timeline-3">
                            <div class="timeline-items">

                                @forelse($histories->where("is_comment",1) as $comment)
                                    <div class="timeline-item pl-0 pl-md-15">
                                        <div class="timeline-media d-none d-md-flex">
                                            <i class="flaticon2-user text-{{$comment->status_color}}"></i>
                                        </div>
                                        <div class="timeline-content rounded-sm">
                                            <div
                                                class="d-md-flex align-items-center justify-content-md-between mb-3">
                                                <div class="mr-2 d-md-flex ">
                                                    <a href=""
                                                       class="text-dark-75 text-hover-primary font-weight-bold">
                                                        {{$comment->user->name??''}}
                                                    </a>
                                                    <span class="text-muted ml-2 d-block">
                                                        {{$comment->created_at->format('h:i A , d M')}} -
                                                        <small> {{$comment->created_at->diffForHumans()}} </small></span>
                                                </div>

                                                <span
                                                    class="label label-light-{{$comment->status_color}}  label-inline ml-2 rounded-pill">{{$comment->status}}</span>

                                            </div>
                                            <p class="p-0">
                                                {{ $comment->comment }}
                                            </p>
                                            @if($comment->attachments)
                                                <div class="mt-3">
                                                    <a href="{{$comment->getAttachment()}}" target="_blank" class="btn btn-sm btn-light-success btn-icon rounded-circle" data-toggle="tooltip" data-placement="top" title="Download Attachment">
                                                        <i class="flaticon-download-1"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if($comment->external_comment)
                                                <a href="#"
                                                   class="text-muted text-hover-primary font-weight-bold">
                                                    Message to applicant
                                                </a>
                                                <p class="p-0">
                                                    {{ $comment->external_comment}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div
                                        class="alert alert-custom alert-notice alert-light-info rounded-0">
                                        <div class="alert-icon">
                                            <i class="flaticon2-chat-1"></i>
                                        </div>
                                        <div class="alert-text">
                                            No comments given yet.
                                        </div>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if(canReviewExpropriation($expropriation))
            @php
                $message=null;
                if(in_array($expropriation->review_decision,[\App\Models\Expropriation::PROPOSE_TO_RETURN_BACK,\App\Models\Expropriation::PROPOSE_TO_REJECT])){
                $message=$expropriation->histories()->latest()->first()->external_comment??null;
                }
            @endphp
            <div class="row">
                <div class="col-md-8">
                    <h4 class="text-center mb-4">Review</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form method="post"
                            action="{{route('admin.expropriations.review',['expropriation'=>$expropriation->id])}}"
                          id="formApprove" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="req_status" value="{{$expropriation->status}}">
                        <div class="form-group row">
                            <label for="status"
                                   class="col-sm-3 col-form-label text-md-right">
                                {{$expropriation->status==\App\Models\ExpropriationBaseModel::REVIEWED?'Mark As':'Decision'}}
                            </label>
                            <div class="col-sm-9">
                                <select required name="status" id="status" class="custom-select">
                                    <option value="">CHOOSE</option>
                                    @foreach($expropriation->getMyStatuses() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status"
                                   class="col-sm-3 col-form-label text-md-right">
                                Attachment
                            </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment"
                                                       name="attachment"
                                                       multiple>
                                                <label class="custom-file-label" for="attachment">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment"
                                   class="col-sm-3 col-form-label text-md-right">Comment</label>
                            <div class="col-sm-9"><textarea required name="comment" id="comment" rows="5"
                                                            class="form-control"></textarea>

                            </div>

                        </div>
                        <div class="form-group row " id="message-container">
                            <label for="message-id"
                                   class="col-sm-3 col-form-label text-md-right">Message To Applicant</label>
                            <div class="col-sm-9">
                                            <textarea name="message" id="message-id" rows="5"
                                                      class="form-control">{{$message??''}}</textarea>

                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-primary"
                                        id="btnSubmit"><span class="la la-check-circle-o"></span>
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>


